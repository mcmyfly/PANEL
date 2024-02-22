<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/user.php'; ?>
<?php require 'inc/_global/token.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>
<?php 
$admin = $_SESSION["admin"];
if (intval($_SESSION["admin"]) != 1){
	header('HTTP/ 404 Not Found', false, 404);
	exit;
}
$notify = "";
$ua = $_SERVER['HTTP_USER_AGENT'];
$date = time();
if (isset($_POST["username"], $_POST["package"])) {
	if ($_POST["package"] == 0){
		$notify .= "$(document).ready(function(){One.helpers('jq-notify', {type: 'warning', icon: 'fa-solid fa-triangle-exclamation me-1', message: 'Lütfen paket seçin!'});});";
	}else{
		$username = mysqli_real_escape_string($conn, $_POST["username"]);
		$package = mysqli_real_escape_string($conn, $_POST["package"]);
		$m_sql = "SELECT premium FROM users WHERE username = '$username'";
		$user_package = mysqli_fetch_assoc(mysqli_query($conn, $m_sql))["premium"];
		if ($user_package == 0){
			$user_package = time();
		}
		if ($package == 1){
			$package_name = "7 GUNLUK";
			$package = strtotime('+7 day', $user_package); 
		}
		elseif ($package == 2){
			$package_name = "1 AYLIK";
			$package = strtotime('+1 month', $user_package); 
		}
		elseif ($package == 3){
			$package_name = "3 AYLIK";
			$package = strtotime('+3 month', $user_package); 
		}
		elseif ($package == 4){
			$package_name = "1 SAATLIK";
			$package = strtotime('+1 hour', $user_package); 
		}
		elseif ($package == 5){
			$package_name = "1 GUNLUK";
			$package = strtotime('+1 day', $user_package); 
		}
		else{
			$package_name = "YOK";
			$package = 0;
		}
		$stmt = $conn->prepare("UPDATE users SET premium = ?, userDef = ? WHERE username = ?");
        $stmt->bind_param("iss", $package, $package_name, $username);
        $stmt->execute();
		$notify .= "One.helpers('jq-notify', {
                    type: 'success',
                    icon: 'fa fa-check me-1',
                    message: '$package_name Başarıyla Tanımlandı!'
                });";
		$stmt = $conn->prepare("INSERT INTO admins (admin, username, package, date, ua) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param("sssis", $_SESSION["username"], $username, $package_name, $date, $ua);
		$stmt->execute();
	}
}else if (isset($_POST["username"], $_POST["vip"])){
	if ($_POST["vip"] == 0){
		$notify .= "$(document).ready(function(){One.helpers('jq-notify', {type: 'warning', icon: 'fa-solid fa-triangle-exclamation me-1', message: 'Lütfen paket seçin!'});});";
	}else{
		$username = mysqli_real_escape_string($conn, $_POST["username"]);
		$vip = mysqli_real_escape_string($conn, $_POST["vip"]);
		$limit = mysqli_real_escape_string($conn, $_POST["limit"]);
		if ($vip == 1){
			$vip_name = "SINIRSIZ SERI NO";
			$vip_time = strtotime('+1 month', time()); 
		}
		elseif ($vip == 2){
			$vip_name = "SINIRSIZ AD SOYAD";
			$vip_time = strtotime('+1 month', time()); 
		}
		elseif ($vip == 3){
			$vip_name = "SINIRSIZ SERI NO VE AD SOYAD";
			$vip_time = strtotime('+1 month', time()); 
		}
		elseif ($vip == 4){
			$vip_time = $limit;
			$vip_name = "SERI NO HAK";
		}
		elseif ($vip == 5){
			$vip_time = $limit;
			$vip_name = "AD SOYAD HAK"; 
		}
		else{
			$vip_name = "YOK";
			$package = 0;
		}
		$stmt = $conn->prepare(sprintf("SELECT id FROM vip WHERE username = ?"));
		$stmt->bind_param('s', $username);
		$stmt->execute();
		$result = $stmt->get_result();
		$rows = $result->num_rows;
		if ($rows == 1){
			$stmt = $conn->prepare("UPDATE vip SET level = ?, userLimit = ? WHERE username = ?");
			$stmt->bind_param("iis", $vip, $vip_time, $username);
			$stmt->execute();
		}else{
			$stmt = $conn->prepare("INSERT INTO vip (username, level, userLimit) VALUES (?, ?, ?)");
			$stmt->bind_param("sii", $username, $vip, $vip_time);
			$stmt->execute();			
		}
		$notify .= "One.helpers('jq-notify', {
                    type: 'success',
                    icon: 'fa fa-check me-1',
                    message: '$package_name Başarıyla Tanımlandı!'
                });";
		$stmt = $conn->prepare("INSERT INTO admins (admin, username, package, date, ua) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param("sssis", $_SESSION["username"], $username, $vip_name, $date, $ua);
		$stmt->execute();
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
</style>
<div class="content">
    <h2 class="d-print-none">Paket Tanımla</h2>
	<form method="POST">
		<div class="row">
        <div class="col-md-12">
            <div class="col-lg-8 col-xl-5">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text">Kullanıcı Adı</span>
                        <input required name="username" type="text" class="form-control">
                    </div>
                </div>
                <div class="mb-4">
					<select required name="package" class="form-select">
					  <option value="0" selected>Lütfen Paket Seçin</option>
					  <option value="1">Haftalık</option>
					  <option value="2">Aylık</option>
					  <option value="3">3 Aylık</option>
					  <option value="0">— OZEL —</option>
					  <option value="4">1 Saatlik</option>
					  <option value="5">1 Günlük</option>
					</select>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-lg-8 col-xl-5">
                <div class="mb-4">
                    <input class="btn btn-secondary" type="submit" value="Tanımla">
                </div>
            </div>
        </div>
    </div>
	</form>
	<h2 class="d-print-none">VIP Tanımla</h2>
	<form method="POST">
		<div class="row">
        <div class="col-md-12">
            <div class="col-lg-8 col-xl-5">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text">Kullanıcı Adı</span>
                        <input required name="username" type="text" class="form-control">
                    </div>
                </div>
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text">Hak</span>
                        <input name="limit" placeholder="Eğer hak ile satılıyorsa hak girin." type="text" class="form-control">
                    </div>
                </div>
                <div class="mb-4">
					<select required name="vip" class="form-select">
					  <option value="0" selected>Lütfen VIP Paket Seçin</option>
					  <option value="1">Aylık Seri No Sınırsız VIP</option>
					  <option value="2">Aylık Ad Soyad Sınırsız VIP</option>
					  <option value="3">Aylık Seri No + Ad Soyad Sınırsız VIP</option>
					  <option value="4">Seri No Hak</option>
					  <option value="5">Ad Soyad Hak</option>
					</select>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-lg-8 col-xl-5">
                <div class="mb-4">
                    <input class="btn btn-secondary" type="submit" value="Tanımla">
                </div>
            </div>
        </div>
    </div>
	</form>
</div>

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php $one->get_js('js/lib/jquery.min.js'); ?>
<?php $one->get_js('js/plugins/jquery-validation/jquery.validate.min.js'); ?>
<?php $one->get_js('js/pages/op_auth_signin.min.js'); ?>
<?php require 'inc/_global/views/footer_end.php'; ?>