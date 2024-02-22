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
if (isset($_POST["username"])) {
		$username = mysqli_real_escape_string($conn, $_POST["username"]);
		$package = 0;
		$stmt = $conn->prepare("UPDATE users SET premium = ? WHERE username = ?");
        $stmt->bind_param("is", $package, $username);
        $stmt->execute();
		$notify .= "One.helpers('jq-notify', {
                    type: 'success',
                    icon: 'fa fa-check me-1',
                    message: 'Paket Başarıyla Kaldırıldı!'
                });";
		$package_name = "PAKET KALDIRILDI";
		$stmt = $conn->prepare("INSERT INTO admins (admin, username, package, date, ua) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param("sssis", $_SESSION["username"], $username, $package_name, $date, $ua);
		$stmt->execute();
	
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
    <h2 class="d-print-none">Paket Sil</h2>
	<form method="POST">
		<div class="row">
        <div class="col-md-12">
            <div class="col-lg-8 col-xl-5">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text">Kullanıcı Adı</span>
                        <input name="username" type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-lg-8 col-xl-5">
                <div class="mb-4">
                    <input class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="left" title="Kullanıcının premium süresini 0 yapar bu aracı kullanırken dikkat edin, silinen paket süresi gözükmez." type="submit" value="Mevcut Paketi Sıfırla">
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