<?php
if (empty($_SESSION)){session_start();}
$conn = new mysqli("localhost", "root", "", "relaxservices");
if ($conn->connect_error) {
  header("Location: bakim.jsp");
}
if (empty($_SESSION["token"])){exit();}
$stmt = $conn->prepare(sprintf("SELECT * FROM users WHERE token = ?"));
$stmt->bind_param('s', $_SESSION["token"]);
$stmt->execute();
$result = $stmt->get_result();
$rows = $result->num_rows;
$user = $result->fetch_assoc();
$admin = $user["admin"];
function pre($pre){
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
          return ' ' . $t . ' ' .$str . ( $t > 1 ? '' : '' ) . ' kaldı.';

      }
  }   
}
function kk($pre){
  $time_difference = time() - $pre;
                              
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
          return $t . ' ' .$str . ( $t > 1 ? '' : '' ) . ' önce.';

      }
  }   
}
if ($admin == 1){
	$sql = "SELECT * FROM users";
	$result = mysqli_query($conn, $sql);
	while($user = mysqli_fetch_assoc($result)) {
		if ($user["bypass"] == 1){
			$bypass = "Var";
		}else{
			$bypass = "Yok";
		}
		if ($user["ban"] > 1 && $user["bypass"] == 0){
			$ban = "Var";
		}else{
			$ban = "Yok";
		}
		$row = array(
			"id" => $user["id"],
			"username" => $user["username"],
			"premium" => pre($user["premium"]),
			"activity" => (kk($user["activity"])) ? kk($user["activity"]) : "ŞİMDİ",
			"query" => kk($user["query"]),
			"expire" => round(intval($user["sessionExpire"]) / 60)."dk",
			"limit" => $user["totalLimit"],
			"queryLimit" => $user["queryLimit"]."sn",
			"bypass" => $bypass,
			"ban" => $ban
			);
		$data[] = $row;
	}



$results = ["sEcho" => 1,

        	"iTotalRecords" => count($data),

        	"iTotalDisplayRecords" => count($data),

        	"aaData" => $data ];


	header('Content-type:application/json;charset=utf-8');
	echo json_encode($results, JSON_PRETTY_PRINT);	
}

?>