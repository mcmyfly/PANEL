<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>
<?php 
if (isset($_SESSION["username"])){
  header("Location: dashboard.jsp");
}else
	$notify = "";
	if (isset($_GET["ref"]) && strlen($_GET["ref"]) == 6){
		$stmt = $conn->prepare(sprintf("SELECT premium FROM users WHERE referrerKey = ?"));
		$stmt->bind_param('s', $_GET["ref"]);
		$stmt->execute();
		$result = $stmt->get_result();
		$rows = $result->num_rows;
		$us = $result->fetch_assoc();
		if ($rows == 0){
			$notify .= "$(document).ready(function(){One.helpers('jq-notify', {type: 'warning', icon: 'fa-solid fa-triangle-exclamation me-1', message: 'Geçersiz referans no!'});});";
			$rfr = "";
			$rfr_dis = "enabled";
		} else if ($rows == 1 && $us["premium"] > time()){
			$rfr = $_GET["ref"];
			$rfr_dis = "disabled";
		} else if ($rows == 1 && $us["premium"] < time()){
			$rfr = "";
			$rfr_dis = "enabled";
			$notify .= "$(document).ready(function(){One.helpers('jq-notify', {type: 'warning', icon: 'fa-solid fa-triangle-exclamation me-1', message: 'Girilen referans numarasının sahibi artık premium değil!'});});";
		}
	}
	if (isset($_POST)){
			if (isset($_POST["signup-username"], $_POST["signup-referrer"], $_POST["signup-password"], $_POST["signup-password-confirm"])){
					$t = time();
					$referrer = mysqli_real_escape_string($conn, $_POST["signup-referrer"]);
					$username = mysqli_real_escape_string($conn, $_POST["signup-username"]);
					$stmt = $conn->prepare(sprintf("SELECT premium FROM users WHERE referrerKey = ?"));
					$stmt->bind_param('s', $referrer);
					$stmt->execute();
					$result = $stmt->get_result();
					$rows = $result->num_rows;
					$us = $result->fetch_assoc();
					if ($rows == 0){
						$notify .= "One.helpers('jq-notify', {type: 'warning', icon: 'fa-solid fa-triangle-exclamation me-1', message: 'Geçersiz referans no!'});";
					}else if ($us["premium"] < time()){
						$notify .= "One.helpers('jq-notify', {type: 'warning', icon: 'fa-solid fa-triangle-exclamation me-1', message: 'Girdilen referans numarasının sahibi artık premium değil!'});";
					}else{
						$username = mysqli_real_escape_string($conn, $_POST["signup-username"]);
						$stmt = $conn->prepare(sprintf("SELECT username FROM users WHERE username = ?"));
						$stmt->bind_param('s', $username);
						$stmt->execute();
						$result = $stmt->get_result();
						$rows = $result->num_rows;
						if ($rows >= 1){
							$notify .= "One.helpers('jq-notify', {type: 'warning', icon: 'fa-solid fa-triangle-exclamation me-1', message: 'Bu kullanıcı adı daha önceden alınmış!'});";
						}else{
							$password = mysqli_real_escape_string($conn, $_POST["signup-password"]);
							$password_1 = sha1(mysqli_real_escape_string($conn, "YuZe4oCE60tJLopk".$_POST["signup-password"]));
							$password_2 = sha1(mysqli_real_escape_string($conn, "YuZe4oCE60tJLopk".$_POST["signup-password-confirm"]));
							$ref_key =  bin2hex(random_bytes(3));
							$tkn =  sha1(bin2hex(random_bytes(24)));
							
							if ($password_1 == $password_2){
								if (strlen($username) >= 4 || strlen($password) >= 8){
									$date = time();
									$queryLimit = 30;
									$sessionExpire = 1500;
									$ua = $_SERVER['HTTP_USER_AGENT'];
									$stmt = $conn->prepare("INSERT INTO users (username, password, userReferrer, referrerKey, token, queryLimit, sessionExpire) VALUES (?, ?, ?, ?, ?, ?, ?)");
									$stmt->bind_param("sssssss", $username, $password_1, $referrer, $ref_key, $tkn, $queryLimit, $sessionExpire);
									$stmt->execute();
									header("Location: giris.jsp");
								}else{
									$notify .= "One.helpers('jq-notify', {type: 'warning', icon: 'fa-solid fa-triangle-exclamation me-1', message: 'Kısa karakter tespit edildi lütfen istenilen karakter sayısında kullanıcı adı ve şifre girin!'});";
								}
							}else{
								$notify .= "One.helpers('jq-notify', {type: 'warning', icon: 'fa-solid fa-triangle-exclamation me-1', message: 'Girilen parolalar eşleşmiyor!'});";
							}
						}
					}
			}else{
				$notify .= "One.helpers('jq-notify', {type: 'warning', icon: 'fa-solid fa-triangle-exclamation me-1', message: 'Gerekli tüm alanları doldurun!'});";
			}
	}
?>
<!-- Page Content -->
<div class="hero-static d-flex align-items-center">
  <div class="content">
    <div class="row justify-content-center push">
      <div class="col-md-8 col-lg-6 col-xl-4">
        <!-- Sign Up Block -->
        <div class="block block-rounded mb-0">
          <div class="block-header block-header-default">
            <h3 class="block-title">Hesap Oluştur</h3>
            <div class="block-options">
              <a class="btn-block-option" href="giris.jsp" data-bs-toggle="tooltip" data-bs-placement="left" title="Giriş Yap">
                <i class="fa fa-sign-in-alt"></i>
              </a>
            </div>
          </div>
          <div class="block-content">
            <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
			<div class="mb-4" bis_skin_checked="1">
<img id="logo-container" class="h2 mb-1" src="assets/media/photos/relaxlogin.png" alt="Login Logo" style="width: 280px;">
</div>
 <div class="alert alert-primary" role="">
                  Hesabını Oluştur Kaliteyi Sende Hisset.              </div>
              <form class="js-validation-signup" method="POST">
                <div class="py-3">
                  <div class="mb-4">
                    <input type="text" class="form-control form-control-lg form-control-alt" id="signup-username" name="signup-username" placeholder="Kullanıcı Adı"data-bs-toggle="tooltip" data-bs-placement="left" title="Kullanıcı adınızı sonradan değiştiremezsiniz, ilerde diğer kullanıcılar bu ismi görebilir.">
                  </div>
                  <div class="mb-4">
                    <input type="text" <?= $rfr_dis ?> class="form-control form-control-lg form-control-alt" id="signup-referrer" name="signup-referrer" placeholder="Referans No" data-bs-toggle="tooltip" data-bs-placement="left" title="Sistemde kayıtlı olan arkadaşınızın verdiği referans numarası." value="<?= $rfr ?>">
                  </div>
                  <div class="mb-4">
                    <input type="password" class="form-control form-control-lg form-control-alt" id="signup-password" name="signup-password" placeholder="Parola" data-bs-toggle="tooltip" data-bs-placement="left" title="Parolanızı sadece yönetici onayı ile değiştirebilirsiniz, lütfen eşsiz bir parola seçin.">
                  </div>
                  <div class="mb-4">
                    <input type="password" class="form-control form-control-lg form-control-alt" id="signup-password-confirm" name="signup-password-confirm" placeholder="Tekrar Parola">
                  </div>
                  
                </div>
                <div class="row mb-4">
                  <div class="col-md-7 col-xl-8">
                    <button data-bs-toggle="tooltip" data-bs-placement="left" title="Hesabınız oluşturulduktan sonra manuel onay sürecine girecektir. Ortalama onay süresi 5 dakikadır. Yöneticiler hesabınızı onaylayana kadar sabırla bekleyin." type="submit" class="btn w-100 btn-alt-success">
                      <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Kayıt İşlemini Tamamla
                    </button>
                  </div>
                </div>
              </form>
              <!-- END Sign Up Form -->
            </div>
          </div>
        </div>
        <!-- END Sign Up Block -->
      </div>
    </div>
    <div class="fs-sm text-muted text-center">
      <strong><?php echo "Discord RelaX Services -" . ' ' . $one->version; ?></strong>  <span data-toggle=""></span>
	  <a class="link-fx" href="https://discord.gg/ef6Dy2SRaz">Discorda Katıl</a> yada <a class="link-fx" href="/kayitolma.php">Kayıt konusunda yardıma ihtiyacın varsa hiç çekinme tıkla</a>
    </div>
  </div>
</div>

<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- jQuery (required for jQuery Validation plugin) -->
<?php $one->get_js('js/lib/jquery.min.js'); ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/jquery-validation/jquery.validate.min.js'); ?>

<!-- Page JS Code -->
<?php $one->get_js('js/pages/op_auth_signup.min.js'); ?>

<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
<script defer>
	$(document).ready(function() {
		$(function() {
            $(this).bind("contextmenu", function(e) {
                e.preventDefault();
            });
        }); 
		$(document).bind('selectstart dragstart', function(e) {
		  e.preventDefault();
		  return false;
		});
		$(document).ready(function(){
		  $(document).bind("cut copy paste",function(e) {
			  e.preventDefault();
		  });
		});
		$('img').on('dragstart', function(event) { event.preventDefault(); });
		$('img').bind('contextmenu', function(e) { return false; }); 
		$('#logo-container').on('contextmenu', 'img', function(e){ return false; });
	}); 
</script>

<?php require 'inc/_global/views/footer_end.php'; ?>
