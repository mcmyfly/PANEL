<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<?php 
if (isset($_SESSION["username"])){
  header("Location: dashboard.jsp");
}
function banDate($pre){
  $time_difference = $pre - time();
                              
  $condition = array( 
      12 * 30 * 24 * 60 * 60 =>  'yıl',
      24 * 60 * 60    =>  'gün',
      60 * 60                 =>  'saat',
      60                      =>  'dakika',
      1                       =>  'saniye'
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
$notify = "";
ini_set('mysql.connect_timeout','15'); 
$authCode = hash("sha512", strtotime('+1 minutes'));
setcookie("JSPAUTH", $authCode, time() + (86400 * 30), "/");
if (isset($_POST['h-captcha-response'])){
$data = array(
            'secret' => "0x1139feEA1614DE61B5495ce8624413c58E345b27",
            'response' => $_POST['h-captcha-response']
        );
      
$verify = curl_init();
curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
curl_setopt($verify, CURLOPT_POST, true);
curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($verify);
//var_dump($response);
$responseData = json_decode($response);
if($responseData->success) {
if (isset($_POST["login-username"], $_POST["login-password"])){
  $username = mysqli_real_escape_string($conn, $_POST["login-username"]);
  $password = sha1(mysqli_real_escape_string($conn, "AOREFGİSmkneoolsakİiİİİ".$_POST["login-password"]));
  $stmt = $conn->prepare(sprintf("SELECT * FROM users WHERE username = ? AND password = ?"));
  $date = time();
  $ua = $_SERVER['HTTP_USER_AGENT'];
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
  $ip = substr_replace($ip, '.**', -2);
  $stmt->bind_param('ss', $username, $password);
  $stmt->execute();
  $result = $stmt->get_result();
  $rows = $result->num_rows;
  if ($rows == 1){
    $user = $result->fetch_assoc();
	$mnt = round($user["sessionExpire"]/60);
    $lifetime = strtotime("+$mnt minutes", 0);
    session_set_cookie_params($lifetime);
	if ($user["verify"] == 100){ //tekrar düzeltmek icin 100 ü 0 yap
		$notify .= "One.helpers('jq-notify', {type: 'warning', icon: 'fa-solid fa-user-tie me-1', message: 'Hesabınız yönetici onayı bekliyor. Hesabınız onaylanmadan sisteme giriş yapamazsınız. Ortalama onay süresi 1 gündür.'});";
	}else if ($user["premium"] < time()){
      $notify .= "One.helpers('jq-notify', {type: 'warning', icon: 'fa fa-star me-1', message: 'Üyeliğin Bulunmuyor!'});";
    }else{
      $jspcsrf = hash("adler32", time()."ILLEGALCITYYuZe4oCE60tJLopk");
      $username = $user["username"];
      if ($user["ban"] == 1 && $user["bypass"] != 1 || $user["bypass"] != 1 && $user["ban"] != 0 && $user["ban"] > time()){
        $banDef = ($user["banDef"]) ? $user["banDef"] : "YOK";
        $userDef = ($user["userDef"]) ? $user["userDef"] : "YOK";
        $kalan = ($user["premium"]) ? banDate($user["premium"]) : "YOK";
        if ($user["ban"] == 1){
          $banDate = "Süresiz.";
        }else if ($user["ban"] != 0 && $user["ban"] != 1){
          $banDate = banDate($user["ban"]);
        }
        $notify .= "One.helpers('jq-notify', {type: 'danger', icon: 'fa fa-times me-1', message: 'Hey selam değerli orospu çocğu :D Sistemimizde multi yasak ananın amına soktum üyeliği!'});";
   
	  }else{
		$stmt = $conn->prepare("INSERT INTO logins (username, validateToken, ip, date, userAgent) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $username, $jspcsrf, $ip, $date, $ua);
        $stmt->execute();
        $_SESSION["userid"] = $user["id"];
        $_SESSION["username"] = $username;
        $_SESSION["token"] = $user["token"];
        $_SESSION["token_time"] = time();
        header("Location: changelog.jsp");
			  }
		  }

      }

    }
  }else{
    $notify .= "One.helpers('jq-notify', {type: 'danger', icon: 'fa fa-times me-1', message: 'Tüm üyelikler silindi! Discord üzerinden üyeliğini tekrar onaylat.'});";
  }
}

else {
$notify .= "One.helpers('jq-notify', {type: 'warning', icon: 'fa-solid fa-triangle-exclamation me-1', message: 'Lütfen captcha robot doğrulamasını geçin.'});";
}	



?>
<div class="hero-static d-flex align-items-center">
  <div class="content">
    <div class="row justify-content-center push">
      <div class="col-md-8 col-lg-6 col-xl-4">
        <div class="block block-rounded mb-0">
          <div class="block-header block-header-default">
            <h3 class="block-title">Giriş Yap</h3>
			            <div class="block-options">
              <a class="btn-block-option" href="kayit.jsp" data-bs-toggle="tooltip" data-bs-placement="left" title="Kayıt OL">
                <i class="fa fa-fw fa-plus me-1"></i>
              </a>
            </div>
          </div>
          <div class="block-content">
            <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
            
              <!--  <p class="fw-medium text-muted">
                Hoşgeldin, lütfen giriş yap.
              </p> -->
              <form class="js-validation-signin" action="" method="POST">
                <div class="py-3">
				  <div class="mb-4">
                    <img id="logo-container" class="h2 mb-1" src="<?php echo $one->assets_folder; ?>/media/photos/arkasiolanbanner44.png" alt="Login Logo" style="width: 280px;">
                  </div>
                  <div class="mb-4">
                    <input type="text" class="form-control form-control-alt form-control-lg" id="login-username" name="login-username" placeholder="Kullanıcı Adı">
                  </div>
                  <div class="mb-4">
                    <input type="password" class="form-control form-control-alt form-control-lg" id="login-password" name="login-password" placeholder="Parola">
                  </div>
                  <div class="mb-4">
                    <div class="h-captcha" data-theme="dark" data-size="normal" data-sitekey="3ba61b7f-cfd8-49d2-a093-3914f27b0fb9" data-bs-toggle="tooltip" data-bs-placement="left" title="Captcha işaretlenmesi zorunludur!"></div>
                  </div>
                </div>
                <div class="row mb-4">
                  <div class="col-md-6 col-xl-5">
                    <button data-bs-toggle="tooltip" data-bs-placement="left" title="Çoklu cihaz kullanımı sistemden yasaklanma sebebidir. Eğer hesabınızı paylaştıysanız sistem bu oturumu otomatik algılayıp hesabınızı belirlenen süre içerisinde yasaklayacaktır." type="submit" class="btn w-100 btn-alt-primary">
                      <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> Giriş
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="fs-sm text-muted text-center">
      <strong><?php echo "Tospiscik" . ' ' . $one->version; ?></strong> &copy; <span data-toggle="year-copy"></span>
    </div>
  </div>
</div>

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php $one->get_js('js/lib/jquery.min.js'); ?>
<?php $one->get_js('js/plugins/jquery-validation/jquery.validate.min.js'); ?>
<script src='https://www.hCaptcha.com/1/api.js' async defer></script>
<?php $one->get_js('js/pages/op_auth_signin.min.js'); ?>
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