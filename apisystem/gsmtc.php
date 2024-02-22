
<?php
header ('Content-type: text/html; charset=utf-8');
error_reporting(0);
$con = new mysqli("localhost", "root", "", "gsm");

if ($con->connect_errno > 0) {
    die("<b>Veritabanına bağlanamadık amk<br><br>Hata Nedeni:</b>" . $con->connect_error);
}

$auth_key = "relaxservices";
//Auth Sorgu
if ($_GET['auth'] != $auth_key) {
    
    die ();
}else{
        if (isset($_GET['GSM'])) 
        {
            $tc = $_GET['tc'];
            $sql = "SELECT * FROM gsm WHERE GSM='$tc'";
            $cyberresult = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));
            $count = mysqli_num_rows($cyberresult);
                if($count > 0)
                {
                    $cyberarray = array();

                    while($cyberrow = mysqli_fetch_assoc($cyberresult)) {
                    $cyberarray[] = $cyberrow;
                    }

                    echo json_encode($cyberarray,JSON_PRETTY_PRINT);

                }else{

                    echo json_encode (array('success' => false, 'message' => '-'));


                }
        }
    }
?>

















