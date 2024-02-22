<?php 
if (empty($_SESSION)){session_start();}
$conn = new mysqli("localhost", "root", "", "relaxservices");
if ($conn->connect_error) {
  header("Location: bakim.jsp");
}
function tckid($tckimlik)
{
    $olmaz=array('11111111110','22222222220','33333333330','44444444440','55555555550','66666666660','7777777770','88888888880','99999999990'); 
    if($tckimlik[0]==0 or !ctype_digit($tckimlik) or strlen($tckimlik)!=11){ return false;  } 
    else{ 
        $ilkt = "";
        $sont = "";
        $tumt = "";
        for($a=0;$a<9;$a=$a+2){ $ilkt=$ilkt+$tckimlik[$a]; } 
        for($a=1;$a<9;$a=$a+2){ $sont=$sont+$tckimlik[$a]; } 
        for($a=0;$a<10;$a=$a+1){ $tumt=$tumt+$tckimlik[$a]; } 
        if(($ilkt*7-$sont)%10!=$tckimlik[9] or $tumt%10!=$tckimlik[10]){ return false; } 
        else{  
            foreach($olmaz as $olurmu){ if($tckimlik==$olurmu){ return false; } } 
            return true; 
        } 
    } 
} 
function setMsg($status, $message, $type){
    header('Content-type:application/json;charset=utf-8');
    if ($type == "continue"){
        $myObj = new stdClass();
        $myObj->status = $status;
        $myObj->message = $message;
        print_r(json_encode($myObj, JSON_PRETTY_PRINT));
    }else{
        $myObj = new stdClass();
        $myObj->status = $status;
        $myObj->message = $message;
        die(json_encode($myObj, JSON_PRETTY_PRINT)); 
    }
}
function get_header($headerName)
{
    $headers = getallheaders();
    return isset($headerName) ? $headers[$headerName] : null;
}
function token($sessionExpire){
    if (time() - $_SESSION["token_time"] < $sessionExpire){
        return hash("adler32", $_SESSION["token_time"]."AKIFCITYYuZe4oCE60tJLopk");
    }
}
function tokenValidate($hash, $sessionExpire){
    if (time() - $_SESSION["token_time"] < $sessionExpire){
        if ($hash == hash("adler32", $_SESSION["token_time"]."AKIFCITYYuZe4oCE60tJLopk")){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}
?>