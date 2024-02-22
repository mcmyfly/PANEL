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
}?>	
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
    <h2 class="d-print-none">Kullanıcı Oturum Açma Kayıtları</h2>

            <div class="table-responsive">
	<table id="t" class="table  table-vcenter">
    <thead>
        <tr>
            <th style="font-size:12px">ID</th>
            <th style="font-size:12px">Ad</th>
            <th style="font-size:12px">Token</th>
			<th style="font-size:12px">Tarih</th>
			<th style="font-size:12px">IP</th>
			<th style="font-size:12px">UA</th>
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
			$sql = "SELECT * FROM logins ORDER BY id DESC";
			$result = mysqli_query($conn, $sql);
			while($user = mysqli_fetch_assoc($result)) {
				echo "<tr>";
				echo '<td>'.$user["id"].'</td>';
				echo '<td>'.$user["username"].'</td>';
				echo '<td>'.$user["validateToken"].'</td>';
				echo '<td>'.kk($user["date"]).'</td>';
				echo '<td>'.$user["ip"].'</td>';
				echo '<td>'.$user["userAgent"].'</td>';
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