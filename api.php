<?php
header ('Content-type: text/html; charset=utf-8'); 

$con = new mysqli("localhost", "root", "", "101m");

if ($con->connect_errno > 0) {
    die("<b>Bağlantı Hatası:</b> " . $con->connect_error);
}

if(isset($_GET['ad'])) {

}
if(isset($_GET['soyad'])) {

}
if(isset($_GET['il'])) {

}
     {
        $ad = $_GET['ad'];
        $soyad = $_GET['soyad'];
        $il = $_GET['il'];
        $sql = "SELECT * FROM 101m WHERE ADI='$ad' AND SOYADI='$soyad' AND NUFUSIL='$il'";
         
        
      
    }
$result = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));

$fayujarray = array();
    while($row = mysqli_fetch_assoc($result)) {

    $fayujarray[] = $row;

  }

echo json_encode($fayujarray, JSON_PRETTY_PRINT);


?>