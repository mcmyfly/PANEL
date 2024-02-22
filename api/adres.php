<?php
$auth_key = "cyberinsikiflnbra";
if ($_GET['auth_key'] != $auth_key) {
    echo json_encode(array("success" => false, 'message' => "Key yanlış amk evladı!"));
    die();
};
$tc = $_GET['tc'];
$url= "https://ajexnetwork.com.tr/api/ikametgah?auth=bDgTffzVLxUQkpjyiaH&tc=$tc";
$bacis1kenfayuj = curl_init($url);
curl_setopt($bacis1kenfayuj, CURLOPT_URL, $url);
curl_setopt($bacis1kenfayuj, CURLOPT_RETURNTRANSFER, true);
curl_setopt($bacis1kenfayuj, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($bacis1kenfayuj, CURLOPT_SSL_VERIFYPEER, false);
$resp = curl_exec($bacis1kenfayuj);
curl_close($bacis1kenfayuj);



        $resp = str_replace('"message": "RelaX API Services discord.gg/ef6Dy2SRaz",', '', $resp);
        $resp = str_replace('"ExtraData": {', '', $resp);
        $resp = str_replace('{\n"FirmTitle":', '', $resp);
        $resp = str_replace('}', '', $resp);
        $resp = str_replace(' "success": true,', '', $resp);
        $resp = str_replace('"FirmTitle": "', 'degisken2', $resp);
        $resp = str_replace('"TaxOffice": "', 'degisken3', $resp);
        $resp = str_replace('"Town": "', 'degisken4', $resp);
        $resp = str_replace('"Address": "', 'degisken5', $resp);
        $resp = str_replace('"CityId"', 'degisken6', $resp);
        $resp = str_replace('",', 'degisken7', $resp);
        $resp = str_replace('"Ikametgah": "', 'degisken8', $resp);
        $resp = str_replace('"', 'degisken9', $resp);
        $resp = str_replace('degisken2', '"FirmTitle": "', $resp);
        $resp = str_replace('degisken3', '"TaxOffice": "', $resp);
        $resp = str_replace('degisken4', '"Town": "', $resp);
        $resp = str_replace('degisken5', '"Address": "', $resp);
        $resp = str_replace('degisken6', '"CityId"', $resp);
        $resp = str_replace('degisken7', '",', $resp);
        $resp = str_replace('degisken8', '"Ikametgah": "', $resp);
        $resp = str_replace('degisken9', '"}', $resp);
        $resp = str_replace('Ikametgah', 'Adresss', $resp);
        $resp = str_replace('{', '[{', $resp);
        $resp = str_replace('}', '}]', $resp);
echo $resp;
?>  