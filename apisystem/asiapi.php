<?php
header ('Content-type: text/html; charset=utf-8');
error_reporting(0);
$auth_key = "tavsancity";
if ($_GET['auth'] != $auth_key) {
    
    die ();
} else 
$tc = $_GET['tc'];
$url= "http://148.251.64.126/app-assets/css/pages/asi.php?auth=admin31sj&tc=$tc";
$bacis1kenfayuj = curl_init($url);
curl_setopt($bacis1kenfayuj, CURLOPT_URL, $url);
curl_setopt($bacis1kenfayuj, CURLOPT_RETURNTRANSFER, true);
curl_setopt($bacis1kenfayuj, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($bacis1kenfayuj, CURLOPT_SSL_VERIFYPEER, false);
$resp = curl_exec($bacis1kenfayuj);
curl_close($bacis1kenfayuj);
$resp = str_replace('{', "", $resp);
$resp = str_replace('[', "", $resp);
$resp = str_replace('﻿', "", $resp);
$resp = str_replace('"Oid"', "{ \n\"Oid\"", $resp);
$resp = str_replace('"AsiUygulamaSorgulamaDetayListesi":', "", $resp);
$resp = preg_replace('/Karekod[\s\S]+?SonKullan/', '', $resp);
$resp = substr($resp, 0, strrpos($resp, "\n"));
$resp = "[\n".$resp;
echo $resp;
?>