<?php 
error_reporting(0);
$date = time();
$ua = $_SERVER['HTTP_USER_AGENT'];
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
$ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
	$ip = $_SERVER['REMOTE_ADDR'];
}
$ip = substr_replace($ip, '**', -2);
function greeting() {
    date_default_timezone_set('Europe/Istanbul');
    $time = date("H");
    $timezone = date("e");
    if ($time < "12") {
        return "Günaydın";
    } else
    if ($time >= "12" && $time < "17") {
        return "İyi Günler";
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
        $input = array("Sabah Sabah Hayırdır Erkencisin", "Şafak mı yedin sabah sabah giriyon!1!!??", "Vurur yüze ifadesi, Günaydın Darkpro ahalisi.", "Bir sana bir de Illgel City'ye doyamadım günaydın…");
    }else{
        $input = array("giriş yaptı. beyler herkes sığınaklara koşsun! ", "ölü taklidi yapın beyler, ifşa etmesin.", "ooo sen buralara gelirmiydin? ", "geldin de ne oldu amk ekran a bakıp çıkıyorsun", "olmasa da bizde lüks bir yaşam, ifşala geç paşaaaam, hoşgeldin.", "ünlü aratmadın dimi? sikerler olum, hepimizi sikerler", "hoşgeldin gönlümün sultanı.", "nerdesin kardeşim sen?", "checker seni özledi be güzel kardeşim.", "sağa baktım kahpeler, sola baktım maddeler. ünlü sorgularsan hepimizi sikerler.", "anca işiniz düşünce gelin zaten. hiç hal hatır yok.", "fazla bakma kafa yapar.", "gel kim olursan ol yine gel");
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
    $premium = $user["premium"];
    $username = $user["username"];
    $token = $user["token"];
    $sessionExpire = $user["sessionExpire"];
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
    $stmt->execute();
	
    $result = mysqli_query($conn, "SELECT COUNT(*) AS `count` FROM `users`");
    $row = mysqli_fetch_array($result);
    $all_count_text = $row['count'];
    $result = mysqli_query($conn, "SELECT COUNT(*) AS `count` FROM `users` WHERE premium > $time");
    $row = mysqli_fetch_array($result);
    $premium_count_text = $row["count"];
    if ($premium < time()){
        header("Location: giris.jsp");
    }
    $query = $user["query"];
    $totalLimit = $user["totalLimit"];
}else{
    header("Location: giris.jsp");
}


?>