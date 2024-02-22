<?php 
require 'inc/_global/config.php';
require 'inc/backend/config.php';
require 'inc/_global/views/head_start.php';
require 'inc/_global/views/head_end.php';
require 'inc/_global/user.php';
require 'inc/_global/token.php';
require 'inc/_global/views/page_start.php';
$one->get_css('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css');
$one->get_css('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css');
$one->get_css('js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css');
$admin = $_SESSION["admin"];
if (intval($_SESSION["admin"]) != 1){
	header('HTTP/ 404 Not Found', false, 404);
	exit;
}
function k_vip($level, $limit){
	$time = time();
	if ($level == 1){
		$paket = "Elite Vip I: ";
		return $paket.vip_time($limit);
	}else if ($level == 2){
		$paket = "Elite Vip II: ";
		return $paket.vip_time($limit);
	}else if ($level == 3){
		$paket = "Super Vip V: ";
		return $paket.vip_time($limit);
	}else if ($level == 4){
		$paket = "Vip I: ";
		return $paket.$limit." Hak Kaldı";
	}else if ($level == 5){
		$paket = "Vip II: ";
		return $paket.$limit." Hak Kaldı";
	}else{
		//  BILINMEYEN LEVEL
		return "Vip Paket Yok";
	}
}
?>	
<style>
table.table-bordered>tbody>tr>td {
    border: 1px solid #364054;
}

table.table-bordered>tbody>tr>th {
    border: 1px solid #364054;
}
.table td {
    font-size: 12px;
}
</style>
<div class="content">
    <h2 class="d-print-none">Tüm Kullanıcılar</h2>

            <div class="table-responsive">
	<table id="t" class="table  table-vcenter">
    <thead>
        <tr>
            <th style="font-size:12px">ID</th>
            <th style="font-size:12px">Ad</th>
            <th style="font-size:12px">Premium</th>
			<th style="font-size:12px">Son Aktivite</th>
			<th style="font-size:12px">Son Sorgu</th>
			<th style="font-size:12px">Oturum Süresi</th>
			<th style="font-size:12px">VIP PAKET</th>
			<th style="font-size:12px">Bekleme Süresi</th>
			<th style="font-size:12px">Ref. Kod</th>
			<th style="font-size:12px">Referans</th>
			<th style="font-size:12px">Bypass</th>
			<th style="font-size:12px">Ban</th>
			<th style="font-size:12px">Eylem</th>
			<th style="font-size:12px">Aktifleştir</th>
        </tr>
    </thead>
    <tbody id="tbod">
	<?php 
		if (empty($_SESSION["token"])){exit();}
		$stmt = $conn->prepare(sprintf("SELECT * FROM users WHERE token = ?"));
		$stmt->bind_param('s', $_SESSION["token"]);
		$stmt->execute();
		$result = $stmt->get_result();
		$rows = $result->num_rows;
		$user = $result->fetch_assoc();
		$admin = $user["admin"];
		function pre($pre){
			if ($pre == 0){
				return "Yok";
			}
		  $time_difference = $pre - time();	  
		  $condition = array( 
			  12 * 30 * 24 * 60 * 60 =>  'Yıl',
			  24 * 60 * 60    =>  'Gün',
			  60 * 60                 =>  'Saat',
			  60                      =>  'Dakika',
			  1                       =>  'Saniye'
		  );
										  
		  foreach( $condition as $secs => $str )
		  {
			  $d = $time_difference / $secs;
										  
			  if( $d >= 1 )
			  {
				  $t = round( $d );
				  return ' ' . $t . ' ' .$str . ( $t > 1 ? '' : '' ) . ' kaldı.';

			  }
		  }   
		}
		function kk($pre){
			if ($pre == 0){
				return "Yok";
			}
		  $time_difference = time() - $pre;
									  
		  $condition = array( 
			  12 * 30 * 24 * 60 * 60 =>  'Yıl',
			  24 * 60 * 60    =>  'Gün',
			  60 * 60                 =>  'Saat',
			  60                      =>  'Dakika',
			  1                       =>  'Saniye'
		  );
										  
		  foreach( $condition as $secs => $str )
		  {
			  $d = $time_difference / $secs;
										  
			  if( $d >= 1 )
			  {
				  $t = round( $d );
				  return $t . ' ' .$str . ( $t > 1 ? '' : '' ) . ' önce.';

			  }
		  }   
		}
		if ($admin == 1){
			$sql = "SELECT * FROM users";
			$result = mysqli_query($conn, $sql);
			while($user = mysqli_fetch_assoc($result)) {
				$rk = $user["userReferrer"];
				$rk = mysqli_real_escape_string($conn, $rk);
				$m_sql = "SELECT username FROM users WHERE referrerKey = '$rk'";
				$m_result = mysqli_query($conn, $m_sql);
				$ref_name = mysqli_fetch_assoc($m_result)["username"];
				$stmt = $conn->prepare(sprintf("SELECT * FROM vip WHERE username = ?"));
				$stmt->bind_param('s', $user["username"]);
				$stmt->execute();
				$result1 = $stmt->get_result();
				$v = $result1->fetch_assoc();
				$k_vip = k_vip($v["level"], $v["userLimit"]);
				if ($user["bypass"] == 1){
					$bypass = "Var";
				}else{
					$bypass = "Yok";
				}
				if ($user["ban"] >= 1 && $user["bypass"] == 0){
					$ban = "Var";
				}else{
					$ban = "Yok";
				}
				if ($user["verify"] == 0){
					$verify_btn = '<a href="active-user?u='.$user["username"].'"<button data-bs-toggle="tooltip" data-bs-placement="left" title="Kullanıcıyı Onayla (Bu işlemi gerçekleştirmeden önce kullanıcıyı sorgulayın.)" class="btn btn-secondary" type="button"><i class="fas fa-user-check"></i></button>';
				}else{
					$verify_btn = '<a href="#"><button data-bs-toggle="tooltip" data-bs-placement="left" title="Kullanıcı zaten aktifleştirilmiş" class="btn btn-secondary" type="button"><i class="fas fa-user"></i></button></a>';
				}
				$edit_btn = '<a href="edit-user?u='.$user["username"].'"><button data-bs-toggle="tooltip" data-bs-placement="left" title="Kullanıcının tüm profilini düzenle" class="btn btn-secondary" type="button"><i class="fas fa-edit"></i></button></a>';
				$x = (kk($user["activity"])) ? kk($user["activity"]) : "ŞİMDİ";
				echo "<tr>";
				echo '<td>'.$user["id"].'</td>';
				echo '<td>'.$user["username"].'</td>';
				echo '<td>'.pre($user["premium"]).'</td>';
				echo '<td>'.$x.'</td>';
				echo '<td>'.kk($user["query"]).'</td>';
				echo '<td>'.round(intval($user["sessionExpire"]) / 60)."dk".'</td>';
				echo '<td>'.$k_vip.'</td>';
				echo '<td>'.$user["queryLimit"].'sn</td>';
				echo '<td>'.$user["referrerKey"].'</td>';
				echo '<td>'.$ref_name.'</td>';
				echo '<td>'.$bypass.'</td>';
				echo '<td>'.$ban.'</td>';
				echo '<td>'.$edit_btn.'</td>';
				echo '<td>'.$verify_btn.'</td>';
				echo "</tr>";
			}
		}
	?>
    </tbody>
</table>
            </div>
 
</div>

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php $one->get_js('js/lib/jquery.min.js'); ?>
<script>
$(document).ready(function() {
    $('#t').dataTable({
        language: {
            url: 'assets/json/turkish.json'
        },
        dom: 'Bfrtip',
        processing: true,
		responsive: true
    });

});


</script>
<?php $one->get_js('js/plugins/datatables/jquery.dataTables.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-buttons/dataTables.buttons.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-buttons-jszip/jszip.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-buttons-pdfmake/pdfmake.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-buttons-pdfmake/vfs_fonts.js'); ?>
<?php $one->get_js('js/plugins/datatables-buttons/buttons.print.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-buttons/buttons.html5.min.js'); ?>
<?php require 'inc/_global/views/footer_end.php'; ?>