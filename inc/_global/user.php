<?php 
error_reporting(0);
function vip_time($pre){
	if ($pre == 0){
		return "Yok";
	}
	if ($pre < time()){
		$mtext = " önce bitmiş.";
		$time_difference =  time() - $pre;
	}else{
		$mtext = " kaldı.";
		$time_difference = $pre - time();
	}  
	$condition = array( 
		12 * 30 * 24 * 60 * 60 	=>  'Yıl',
		24 * 60 * 60    		=>  'Gün',
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
			return ' ' . $t . ' ' .$str . ( $t > 1 ? '' : '' ) . $mtext;
		}
	}   
}
function vip($level, $limit, $query){
	// LEVEL 1 = SERI NO
	// LEVEL 2 = AD SOYAD
	// LEVEL 3 = AD SOYAD + SERI NO
	// LEVEL 4 = SERI NO HAK
	// LEVEL 5 = AD SOYAD HAK
	$time = time();
	if ($level == 1 && $query == 1){
		if ($limit > $time){
			return true;
		}else{
			// VIP SINIRSIZ SURE SONU
			return false;
		}
	}else if ($level == 2 && $query == 2){
		if ($limit > $time){
			return true;
		}else{
			// VIP SINIRSIZ SURE SONU
			return false;
		}
	}else if ($level == 3 && $query == 1 || $query == 2){
		if ($limit > $time){
			return true;
		}else{
			// VIP SINIRSIZ SURE SONU
			return false;
		}
	}else if ($level == 4 && $query == 1){
		if ($limit > 0){
			return true;
		}else{
			// SERI NO VIP HAK BITIMI
			return false;
		}
	}else if ($level == 5 && $query == 2){
		if ($limit > 0){
			return true;
		}else{
			// AD SOYAD VIP HAK BITIMI
			return false;
		}
	}else{
		//  BILINMEYEN LEVEL
		return false;
	}
}

function get_vip($level, $limit){
	$time = time();
	if ($level == 1){
		$paket = "Elite Vip I";
		return '<dt class="fs-3 rainbow rainbow_text_animated">'.$paket.'</dt>
            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">'.vip_time($limit).'</dd>';
	}else if ($level == 2){
		$paket = "Elite Vip II";
		return '<dt class="fs-3 rainbow rainbow_text_animated">'.$paket.'</dt>
            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">'.vip_time($limit).'</dd>';
	}else if ($level == 3){
		$paket = "Super Vip V";
		return '<dt class="fs-3 rainbow rainbow_text_animated">'.$paket.'</dt>
            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">'.vip_time($limit).'</dd>';
	}else if ($level == 4){
		$paket = "Vip I";
		return '<dt class="fs-3 rainbow rainbow_text_animated">'.$paket.'</dt>
            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">'.$limit.' Hak Kaldı.</dd>';
	}else if ($level == 5){
		$paket = "Vip II";
		return '<dt class="fs-3 rainbow rainbow_text_animated">'.$paket.'</dt>
            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">'.$limit.' Hak Kaldı.</dd>';
	}else{
		//  BILINMEYEN LEVEL
		return "Vip Paket Yok!";
	}
}
$date = time();
$ua = $_SERVER['HTTP_USER_AGENT'];
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
$ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
	$ip = $_SERVER['REMOTE_ADDR'];
}
function greeting() {
    date_default_timezone_set('Europe/Istanbul');
    $time = date("H");
    $timezone = date("e");
    if ($time < "12") {
        return "Günaydın";
    } else
    if ($time >= "12" && $time < "17") {
        return "Tünaydın";
    } else
    if ($time >= "17" && $time < "22") {
        return "İyi Akşamlar";
    } else
    if ($time >= "22") {
        return "İyi Geceler";
    }
}
function welcome_text(){
    $gr = greeting();
    if ($gr == "Günaydın"){
        $input = array("Fazla Bakma Kafa Yapar.", "Ölü Taklidi Yapın Beyler, İfşa Etmesin.", "Vurur Yüze İfadesi, Günaydın RelaX Ahalisi.", "Ünlü Aratmadın Dimi? Başımıza Bela Almıyak Paşam", "Giriş Yaptı. Beyler Herkes Sığınaklara Koşsun!", "Olmasa'da Bizde Lüks Bir Yaşam, İfşala Geç Paşam, Hoşgeldin.", "Hoşgeldin Gönlümün Sultanı.", "Panel Seni Özledi Be Güzel Kardeşim.", "Ooo Sen Buralara Gelirmiydin?", "Nerdesin Kardeşim Sen?", "Geldin'de Ne Oldu Amk Ekran'a Bakıp Çıkıyorsun", "Sağa Baktım Kahpeler, Sola Baktım Maddeler. Ünlü Sorgularsan hepimizi Keserler", "Anca İşiniz Düşünce Gelin Zaten. Hiç Hal Hatır Yok.", "Gel Kim Olursan Ol Yine Gel");
    }else{
        $input = array("Giriş Yaptı. Beyler Herkes Sığınaklara Koşsun! ", "Ölü Taklidi Yapın Beyler, İfşa Etmesin.", "Ooo Sen Buralara Gelirmiydin Bacanak? ", "Geldin'de Ne Oldu Amk Ekran'a Bakıp Çıkıyorsun", "Olmasa'da Bizde Lüks Bir Yaşam, İfşala Geç Paşam, Hoşgeldin.", "Ünlü Aratmadın Dimi? Başımıza Bela Almıyak Sonra.", "Hoşgeldin Gönlümün Sultanı.", "Nerdesin karşim Sen?", "Panel Seni Özledi Be Güzel kardeşim.", "Sağa Baktım Kahpeler, Sola Baktım Maddeler. Ünlü Sorgularsan Hepimizi Keserler.", "Anca İşiniz Düşünce Gelin Zaten. Hiç Hal Hatır Yok.", "Fazla Bakma Kafa Yapar.", "Gel Kim Olursan Ol Yine Gel");
    }
    
    $rand_keys = array_rand($input, 2);
    return $input[$rand_keys[0]] . "\n";
}
function premium_text($pre){
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
            return $str . ( $t > 1 ? '' : '' ) . ' kaldı.';

        }
    }   
}
function premium_days($pre){
    $time_difference = $pre - time();
    
    $condition = array( 
        12 * 30 * 24 * 60 * 60 =>  '',
        24 * 60 * 60    =>  '',
        60 * 60                 =>  '',
        60                      =>  '',
        1                       =>  ''
    );
        
    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;
        
        if( $d >= 1 )
        {
            $t = round( $d );
            return ' ' . $t . ' ' . $str . ( $t > 1 ? '' : '' ) . '';
        }
    }   
}

$stmt = $conn->prepare(sprintf("SELECT * FROM users WHERE token = ?"));
$stmt->bind_param('s', $_SESSION["token"]);
$stmt->execute();
$result = $stmt->get_result();
$rows = $result->num_rows;

if ($rows == 1){
    $stmt = $conn->prepare(sprintf("UPDATE users SET activity = ? WHERE token = ?"));
    $time = time();
    $stmt->bind_param('is', $time, $_SESSION["token"]);
    $stmt->execute();
    $user = $result->fetch_assoc();
    if ($user["ban"] != 0 && $user["bypass"] != 1){
        header("Location: cikis.jsp");
    }
	$ref_c = $user["referrerKey"];
    $premium = $user["premium"];
    $username = $user["username"];
    $token = $user["token"];
	$_SESSION["admin"] = $user["admin"];
    $sessionExpire = $user["sessionExpire"];
	$stmt = $conn->prepare(sprintf("SELECT * FROM vip WHERE username = ?"));
	$stmt->bind_param('s', $username);
	$stmt->execute();
	$result = $stmt->get_result();
	$rows = $result->num_rows;
	$v = $result->fetch_assoc();
	$get_vip = get_vip($v["level"], $v["userLimit"]);
	$user_vip_level = $v["level"];
	$user_vip_limit = $v["userLimit"];
    if( !isset( $_SESSION['username'] ) || time() - $_SESSION['token_time'] > $user["sessionExpire"])
    {
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        header("Location: giris.jsp");
    }
    $status_text = $user["userDef"];
    $welcome_text = greeting();
    $welcome_text_1 = welcome_text();
    $premium_text = premium_text($premium);
    $premium_days = premium_days($premium);
	$jspcsrf = hash("adler32", $_SESSION["token_time"]."AKIFCITYYuZe4oCE60tJLopk");
	$basename = str_replace(".php", ".jsp",basename($_SERVER['PHP_SELF']));
    $stmt = $conn->prepare("INSERT INTO useractions (username, page, validateToken, ip, date, userAgent) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $username, $basename, $jspcsrf, $ip, $date, $ua);
    if($basename != "error.jsp" || $basename != "sorgu.jsp"){
		$stmt->execute();
	}
    $result = mysqli_query($conn, "SELECT COUNT(*) AS `count` FROM `users`");
    $row = mysqli_fetch_array($result);
    $all_count_text = $row['count'];
    $result = mysqli_query($conn, "SELECT COUNT(*) AS `count` FROM `users` WHERE premium > $time");
    $row = mysqli_fetch_array($result);
    $premium_count_text = $row["count"];
    $result = mysqli_query($conn, "SELECT COUNT(*) AS `count` FROM `users` WHERE verify = 0");
    $row = mysqli_fetch_array($result);
    $waiting_verify = $row["count"];
    if ($premium < time()){
        header("Location: cikis.jsp");
    }
    $query = $user["query"];
    $totalLimit = $user["totalLimit"];
}else{
    header("Location: giris.jsp");
}


?>