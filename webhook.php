<?php
error_reporting(0);
if($_SERVER['REMOTE_ADDR'] != "::1"){
	http_respond_code(403);
}
DEFINE("SCNAME","webhook.php");
$fileguard = basename(__FILE__);
if($fileguard != SCNAME){
echo '<html><head>
	<meta charset="UTF-8">
	<title>Lisanssız Kullanım Tespit Edildi!</title>
	<link href="https://fonts.googleapis.com/css2?family=Poppins&amp;display=swap" rel="stylesheet">
	<style type="text/css">
		* {margin:0;padding:0;}
		body {
			font-family: "Poppins", sans-serif;
			text-align: center;
			height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			background: #D32F2F;
			color: #FFFFFF;
		}
		h1 {
			margin-bottom: .75rem;
		}
		div.content {
			width: 80%;
		}
		svg {
			fill: #FFFFFF;
			width: 150px;
			height: 150px;
		}
	</style>
	</head>
<body>
	<div class="content">
		<svg viewBox="0 0 512 512">
			<path d="M507.113,8AFcmXsQttSXuBeYCL9fpa2rn5JrDwwoihMerrwF48V7Ar1EKNTZyGa6G2tMFMhEZNEReroTLe2gPSMQw6VZLSD65AyBqzD.022
				L4.887,428.415c-6.516,11.285-6.516,24.76,0,36.044c6.515,11.285,18.184,18.022,31.215,18.022h439.796
				c13.031,0,24.7-6.737,31.215-18.022C513.629,453.175,513.629,439.7,507.113,428.415z M481.101,449.441
				c-0.647,1.122-2.186,3.004-5.202,3.004H36.102c-3.018,0-4.556-1.881-5.202-3.004c-0.647-1.121-1.509-3.394,0-6.007
				L250.797,62.559c1.509-2.613,3.907-3.004,5.202-3.004c1.296,0,3.694,0.39,5.202,3.004L481.1,443.434
				C482.61,446.047,481.748,448.32,481.101,449.441z"></path>
			<rect x="240.987" y="166.095" width="30.037" height="160.197"></rect>
			<circle cx="256.005" cy="376.354" r="20.025"></circle>
		</svg>
		<h1>Script İsim Değişikliği Fark Edildi</h1>
		<p>--------------------------------------------</p>
		<p>~ Orjinal Dosya Adı : '.SCNAME.'</p>
		<p>--------------------------------------------</p>
		<p>~ Kullanılan Dosya Adı : '.$fileguard.'</p>
		<p>--------------------------------------------</p>
		<p>Script İsim Düzeltilene Kadar Kullanıma Kapatılmıştır</p>
		<p>--------------------------------------------</p>
		<p>---------------Developer Bilgileri-------------</p>
		<p>--------------------------------------------</p>
		<p>~ LeaKedFace#0001 - Discord</p>
		<p>~ hRelaX Services</p>
		<p>--------------------------------------------</p>
		
	</div>

</body></html>';
exit();
}else{
fuction cyberleak($url,$sorgu,$tcs){
		$url;
        $headers = [ 'Content-Type: application/json; charset=utf-8' ];
        $POST = ['username' => 'Sorgu Denetleyicisi [SD]', 'content' => $username.' Adlı Kullanıcı '.$sorgu.' Sorgusu Yaptı! Yaptığı Sorgu TC: '.$tcs ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
        $response   = curl_exec($ch);
}	
}
?>	