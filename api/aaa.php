<?php
header("Content-Type: application/json");
$tc1 = $_GET["tc"];
$auth_key = "cyberinsikiflnbra";
$cookieFile = 'C:\xampp\htdocs\api\cookie\cookie.txt';
$Email = "Saadettinb@gmail.com";
$Password = "581066";
if ($_GET['auth_key'] != $auth_key) {
    echo json_encode(array("success" => false, 'message' => "Key yanlış amk evladı!"));
    die();
};
if(empty($tc1)) {
    echo json_encode(array("success" => false, 'message' => "TCKN Giriniz!"));
    die();
};
function makeRequest($tckn, $cookie) {
    $url = "https://ticaret.tmo.gov.tr/Firm/GetFirmDetail";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_ENCODING, "");
    curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie);
    
    $headers = array(
        'Accept: application/json, text/javascript, /; q=0.01',
        'Accept-Encoding: gzip, deflate, br',
        'Accept-Language: tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7',
        'Connection: keep-alive',
        'Content-Length: 46',
        'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
        // 'Cookie: ASP.NET_SessionId=asdasd; tmo_eldes=ffffffffaf181e2d45525d5f4f58455e445a4a42378b',
        'Host: ticaret.tmo.gov.tr',
        'Origin: https://ticaret.tmo.gov.tr/',
        'Referer: https://ticaret.tmo.gov.tr/User/FirmRegister',
        'sec-ch-ua: "Google Chrome";v="107", "Chromium";v="107", "Not=A?Brand";v="24"',
        'sec-ch-ua-mobile: ?0',
        'sec-ch-ua-platform: "Windows"',
        'Sec-Fetch-Dest: empty',
        'Sec-Fetch-Mode: cors',
        'Sec-Fetch-Site: same-origin',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36',
        'X-Requested-With: XMLHttpRequest',
    );

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    
    $data = "IsLegalEntity=false&IdentityNumber=$tckn";

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
    $resp = curl_exec($curl);
    curl_close($curl);

    $eski   = array('{"success":true,"message":','}}');

    $yeni   = array('[','}]');

    $metin = str_replace($eski, $yeni, $resp);
    // set_time_limit(5);
    return $metin;
}

function newCookie($cookieFile, $Email, $Password) {
    $post_data = array(
        'Email' => $Email,
        'Password' => $Password
    );
    
    $login_url = 'https://ticaret.tmo.gov.tr/User/Login';

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $login_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);

    $res = curl_exec($ch);

    curl_close($ch);

    return "Başarılı";
}

$res = makeRequest($tc1, $cookieFile);

if(strpos($res, "Object moved to")) {
    newCookie($cookieFile, $Email, $Password);
    $ret = makeRequest($tc1, $cookieFile);
    print_r($ret);
} else {
    print_r($res);
};
?>