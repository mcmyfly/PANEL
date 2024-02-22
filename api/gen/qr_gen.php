<?php
use OTPHP\TOTP;

function generate_code(){
    date_default_timezone_set('Europe/Istanbul');
    include_once(__DIR__.'/vendor/autoload.php');
    $secret = "LF3XI2SHOJWC6T3QMNZXSRRWOBMHOOLWNRBUY3JLOAYHI3SRKVYFO6KIN43USRSQJNKUUWSYKJTEK5SXNNHWKTZSJI4GW2RLKU2XCNA";
    $otp = TOTP::create($secret);
    $kod = $otp->now();
    return $kod;
}