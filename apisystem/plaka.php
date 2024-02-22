<?php
header ('Content-type: text/html; charset=utf-8'); 

$con = new mysqli("localhost", "root", "", "75k_plaka");

if ($con->connect_errno > 0) {
    die("<b>Bağlantı Hatası:</b> " . $con->connect_error);
}

if(isset($_GET['plaka'])) {

}
     {
        $plaka = $_GET['plaka'];
    
        $sql = "SELECT * FROM 75kplaka WHERE Plaka_No='$plaka'";
         
        
      
    }
$result = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));

$fayujarray = array();
    while($row = mysqli_fetch_assoc($result)) {

    $fayujarray[] = $row;

  }

echo json_encode($fayujarray, JSON_UNESCAPED_UNICODE);


?>