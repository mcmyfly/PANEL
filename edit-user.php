<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
textarea:focus, input:focus{
    outline: none;
}
.inp{
    display: block;
    font-size:16px;
    border:solid 2px white;
	border-radius: 10px;
	padding: 15px;
	width: 80%;
	font-weight: bold;
	color: white;
}
.btn {
	font-size:18px;
	margin-top: 20px;
	width: 60%;
	border:solid 2px white;
	border-radius: 10px;
	padding: 10px;
	color: white;
}
*{
	background-color: black;
	font-family: 'Poppins', sans-serif;
}
p{
	color: white;
	font-size: 14px;
}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php
if (empty($_SESSION)){session_start();}
$conn = new mysqli("localhost", "root", "", "relaxservices");
if ($conn->connect_error) {
  header("Location: bakim.jsp");
}
if (empty($_SESSION["token"])){exit();}
$stmt = $conn->prepare(sprintf("SELECT * FROM users WHERE token = ?"));
$stmt->bind_param('s', $_SESSION["token"]);
$stmt->execute();
$result = $stmt->get_result();
$rows = $result->num_rows;
$user = $result->fetch_assoc();
$admin = $user["admin"];
function pre($pre){
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
$t = time();
if (isset($_POST["token"])){
	$token = $_POST["token"];
	$sessionExpire = $_POST["sessionExpire"]*60;
	$totalLimit = $_POST["totalLimit"];
	$ban = $_POST["ban"];
	$banDef = $_POST["banDef"];
	$bypass = $_POST["bypass"];
	$queryLimit = $_POST["queryLimit"];
	$userDef = $_POST["userDef"];
	if (isset($_POST["password"])){
		$pw = sha1(mysqli_real_escape_string($conn, "YuZe4oCE60tJLopk".$_POST["password"]));
		$stmt = $conn->prepare("UPDATE users SET password = ?, sessionExpire = ?, totalLimit = ?, ban = ?, banDef = ?, bypass = ?, queryLimit = ?, userDef = ? WHERE token = ?");
		$stmt->bind_param("siiisiiss", $pw, $sessionExpire, $totalLimit, $ban, $banDef, $bypass, $queryLimit, $userDef, $token);
		$stmt->execute();
	}
	$stmt = $conn->prepare("UPDATE users SET sessionExpire = ?, totalLimit = ?, ban = ?, banDef = ?, bypass = ?, queryLimit = ?, userDef = ? WHERE token = ?");
    $stmt->bind_param("iiisiiss", $sessionExpire, $totalLimit, $ban, $banDef, $bypass, $queryLimit, $userDef, $token);
    $stmt->execute();
	header("Location: kullanicilar.jsp");
}else{
$stmt = $conn->prepare(sprintf("SELECT * FROM users WHERE username = ?"));
$stmt->bind_param('s', $_GET["u"]);
$stmt->execute();
$result = $stmt->get_result();
$rows = $result->num_rows;
	if ($rows == 1){
			$stmt = $conn->prepare(sprintf("UPDATE users SET activity = ? WHERE token = ?"));
			$time = time();
			$stmt->bind_param('is', $time, $_SESSION["token"]);
			$stmt->execute();
			while($user = $result->fetch_assoc()) {
				$x = (kk($user["activity"])) ? kk($user["activity"]) : "ŞİMDİ";
				echo "<center>";
				echo "<form method='POST'>";
				echo "<input name='token' style='visibility: hidden'class='inp' type='text' value='$user[token]'>";
				echo "<p>Kullanıcı Adı:</p>";
				echo "<input name='username' disabled class='inp' type='text' value='$user[username]'>";
				echo "<p>Parola:</p>";
				echo "<input name='password' class='inp' type='password' placeholder='Değiştirmek istiyorsanız doldurun!'>";
				echo "<p>Oturum Süresi (Dakika Cinsinden Yazınız.):</p>";
				echo "<input name='sessionExpire' class='inp' type='text' value='".round(intval($user["sessionExpire"]) / 60)."'>";
				echo "<p>VIP Sorgu Hakkı:</p>";
				echo "<input name='totalLimit' class='inp' type='text' value='$user[totalLimit]'>";
				echo "<p>Ban:</p>";
				echo "<input name='ban' class='inp' type='text' value='$user[ban]'>";
				echo "<p>Eğer Banlıyorsanız Ban Nedeni:</p>";
				echo "<input name='banDef' class='inp' type='text' placeholder='Sadece banlıyorsanız neden girin.' value='$user[banDef]'>";
				echo "<p>Bypass:</p>";
				echo "<input name='bypass' class='inp' type='text' value='$user[bypass]'>";
				echo "<p>Sorgu Limiti (Saniye Cinsinden Yazınız.):</p>";
				echo "<input name='queryLimit' class='inp' type='text' value='$user[queryLimit]'>";
				echo "<p>Kullanıcı Tanımı (Sağ Üstte Çıkış Yaparken Gözükür.):</p>";
				echo "<input name='userDef' class='inp' type='text' value='$user[userDef]'>";
				echo "<input class='btn' type='submit' value='Güncelle'>";
				echo "</form>";
				echo "</center>";
			}
	}else{
		die("<p style='color:white'>kullanıcı bulunamadı.</p>");
	}	
}
}

?>