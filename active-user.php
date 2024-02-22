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
$ua = $_SERVER['HTTP_USER_AGENT'];
$date = time();
if ($admin == 1){
	$t = time();
	if (isset($_GET["u"])){
		$verify = 1;
		$username = $_GET["u"];
		$stmt = $conn->prepare("UPDATE users SET verify = ? WHERE username = ?");
		$stmt->bind_param("is", $verify, $username);
		$stmt->execute();
		$package_name = "ONAYLANDI";
		$stmt = $conn->prepare("INSERT INTO admins (admin, username, package, date, ua) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param("sssis", $_SESSION["username"], $username, $package_name, $date, $ua);
		$stmt->execute();
		header("Location: kullanicilar.jsp");
	}
}