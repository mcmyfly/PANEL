<?php
if (empty($_SESSION)) {
    session_start();
}
require '../inc/_global/token.php';
require '../inc/_global/user.php';
require("gen/qr_gen.php");
function yakinlikDurumu($yakinlik)
{
    $json_string     = file_get_contents('durum.json');
    $parsed_json     = json_decode($json_string, true);
    foreach ($parsed_json as $value) {
        if ($yakinlik == $value["Value"]) {
            return $value["Text"];
            break;
        }
    }
}

error_reporting(0);
$code = generate_code();
if (!empty(get_header("action")) && !empty(get_header("jspcsrf"))) {
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
    $date = time();
    $ua = $_SERVER['HTTP_USER_AGENT'];
    $action = get_header("action");
    $jspcsrf = get_header("jspcsrf");
    if (tokenValidate($jspcsrf, $sessionExpire)) {
        if ($action == "Mernis-Tc") {
            if (!empty(get_header("tc"))) {
                $tc = mysqli_real_escape_string($conn, get_header("tc"));
                if (ctype_digit($tc)) {
                    if (tckid($tc)) {
                        $stmt = $conn->prepare(sprintf("SELECT query, queryLimit FROM users WHERE token = ?"));
                        $stmt->bind_param('s', $token);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $queryResp = $result->fetch_assoc();
                        $query = $queryResp["query"];
                        $queryLimit = $queryResp["queryLimit"];
                        $current_time = time();
                        $check = $current_time - $query;
                        if ($check >= $queryLimit) {
                            $stmt = $conn->prepare("INSERT INTO logs (username, query, token, validateToken, ip, processAction, processDate, userAgent) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                            $stmt->bind_param("ssssssis", $username, $tc, $token, $jspcsrf, $ip, $action, $date, $ua);
                            $stmt->execute();
                            $url = "http://127.0.0.1:3131/hsys?code=$code&action=gsmtc&tc=$tc";
                            $curl = curl_init($url);
                            curl_setopt($curl, CURLOPT_URL, $url);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
							curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 
							curl_setopt($ch, CURLOPT_TIMEOUT, 10000); //timeout in seconds
                            $resp = json_decode(curl_exec($curl), true);
                            curl_close($curl);
                            if ($resp == null) {
                                header('HTTP/ 404 Not Found', false, 404);
                                setMsg("failed", "Aradığınız şahıs bulunamadı.", "die");
                            } elseif ($resp["Message"] == "Hastanın kimlik numarası hatalıdır.") {
                                header('HTTP/ 404 Not Found', false, 404);
                                setMsg("failed", "Aradığınız şahıs bulunamadı.", "die");
                            } elseif ($resp["Message"] == "Kayıt Bulunamadı") {
                                header('HTTP/ 404 Not Found', false, 404);
                                setMsg("failed", "Aradığınız şahıs bulunamadı.", "die");
                            }
                            $stmt = $conn->prepare("UPDATE users SET query = ? WHERE token = ?");
                            $stmt->bind_param("is", $date, $token);
                            $stmt->execute();
                            header('Content-type:application/json;charset=utf-8');
                            echo (json_encode($resp, JSON_PRETTY_PRINT));
                        } else {
                            header('HTTP/ 429 Too Many Requests', false, 429);
                            setMsg("failed", "Size tanımlanan sürenin dışında istek gönderiyorsunuz, lütfen $queryLimit saniyede bir istek atın.", "die");
                        }
                    } else {
                        header("HTTP/1.0 401 Unauthorized");
                        setMsg("failed", "Tc gerçekliği doğrulanamadı.", "die");
                    }
                } else {
					$message = "TC Bölümüne Int yerine String Gönderildi. Potansiyel: SQL INJECT";
					$stmt = $conn->prepare("INSERT INTO warnings (username, validateToken, message, ip, date, userAgent) VALUES (?, ?, ?, ?, ?, ?)");
					$stmt->bind_param("ssssis", $username, $jspcsrf, $message, $ip, $date, $ua);
					$stmt->execute();
                    header("HTTP/1.0 401 Unauthorized");
                    setMsg("failed", "yanlış yerdesin koçum", "die");
                }
            } else {
                header("HTTP/1.0 401 Unauthorized");
                setMsg("failed", "tc atmadın ki sen nasıl hecmkırsın :D", "die");
            }
        } else if ($action == "Fotograf-Tc") {
            if (!empty(get_header("tc"))) {
                $tc = mysqli_real_escape_string($conn, get_header("tc"));
                if (ctype_digit($tc)) {
                    if (tckid($tc)) {
                        $stmt = $conn->prepare(sprintf("SELECT query, queryLimit FROM users WHERE token = ?"));
                        $stmt->bind_param('s', $token);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $queryResp = $result->fetch_assoc();
                        $query = $queryResp["query"];
                        $queryLimit = $queryResp["queryLimit"];
                        $current_time = time();
                        $check = $current_time - $query;
                        if ($check >= $queryLimit) {
                            header('Content-type:application/json;charset=utf-8');
                            $stmt = $conn->prepare("INSERT INTO logs (username, query, token, validateToken, ip, processAction, processDate, userAgent) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                            $stmt->bind_param("ssssssis", $username, $tc, $token, $jspcsrf, $ip, $action, $date, $ua);
                            $stmt->execute();
                            $url = "http://127.0.0.1:3131/osym?tcno=$tc";
                            $curl = curl_init($url);
                            curl_setopt($curl, CURLOPT_URL, $url);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                            curl_setopt($curl, CURLOPT_USERAGENT, "RobloxDunyasi-API");
                            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                            $resp = curl_exec($curl);
                            curl_close($curl);
                            $data = json_decode($resp, true);
                            $base64_string = $data["data"]["KimlikBilgiViewModel"]["FotografBilgi"]["Data"];
                            $dtm = ("data:image/jpeg;base64," . $base64_string);
                            $myObj = new stdClass();
                            $myObj->img_path = ($dtm) ? $dtm : "YOK";
                            $myObj->ad = ($data["data"]["KimlikBilgiViewModel"]["KimlikBilgi"]["Ad"]) ? $data["data"]["KimlikBilgiViewModel"]["KimlikBilgi"]["Ad"] : "YOK";
                            $myObj->soyad = ($data["data"]["KimlikBilgiViewModel"]["KimlikBilgi"]["Soyad"]) ? $data["data"]["KimlikBilgiViewModel"]["KimlikBilgi"]["Soyad"] : "YOK";
                            $myObj->ana_adi = ($data["data"]["KimlikBilgiViewModel"]["KimlikBilgi"]["AnneAdi"]) ? $data["data"]["KimlikBilgiViewModel"]["KimlikBilgi"]["AnneAdi"] : "YOK";
                            $myObj->baba_adi = ($data["data"]["KimlikBilgiViewModel"]["KimlikBilgi"]["BabaAdi"]) ? $data["data"]["KimlikBilgiViewModel"]["KimlikBilgi"]["BabaAdi"] : "YOK";
                            $myObj->dogum_tarihi = ($data["data"]["KimlikBilgiViewModel"]["KimlikBilgi"]["DogumTarihi"]) ? $data["data"]["KimlikBilgiViewModel"]["KimlikBilgi"]["DogumTarihi"] : "YOK";
                            $myObj->dogum_yeri = ($data["data"]["KimlikBilgiViewModel"]["KimlikBilgi"]["DogumYeri"]) ? $data["data"]["KimlikBilgiViewModel"]["KimlikBilgi"]["DogumYeri"] : "YOK";
                            $myObj->nufus_il = ($data["data"]["KimlikBilgiViewModel"]["KimlikBilgi"]["NufusIl"]["AdRo"]) ? $data["data"]["KimlikBilgiViewModel"]["KimlikBilgi"]["NufusIl"]["AdRo"] : "YOK";
                            $myObj->nufus_ilce = ($data["data"]["KimlikBilgiViewModel"]["KimlikBilgi"]["NufusIlce"]["AdRo"]) ? $data["data"]["KimlikBilgiViewModel"]["KimlikBilgi"]["NufusIlce"]["AdRo"] : "YOK";
                            $myObj->adres = ($data["data"]["AdresIletisimBilgi"]["AdresIletisim"]["Adres"]) ? $data["data"]["AdresIletisimBilgi"]["AdresIletisim"]["Adres"] : "YOK";
                            $myObj->tel_no = ($data["data"]["AdresIletisimBilgi"]["AdresIletisim"]["CepTelefonu"]) ? $data["data"]["AdresIletisimBilgi"]["AdresIletisim"]["CepTelefonu"] : "YOK";
                            $myObj->eposta = ($data["data"]["AdresIletisimBilgi"]["AdresIletisim"]["EPosta"]) ? $data["data"]["AdresIletisimBilgi"]["AdresIletisim"]["EPosta"] : "YOK";
                            $myObj->cinsiyet = ($data["data"]["KimlikBilgiViewModel"]["CinsiyetString"]) ? $data["data"]["KimlikBilgiViewModel"]["CinsiyetString"] : "YOK";
                            $stmt = $conn->prepare("UPDATE users SET query = ? WHERE token = ?");
                            $stmt->bind_param("is", $date, $token);
                            $stmt->execute();
                            echo json_encode($myObj, JSON_PRETTY_PRINT);
                        } else {
                            header('HTTP/ 429 Too Many Requests', false, 429);
                            setMsg("failed", "Size tanımlanan sürenin dışında istek gönderiyorsunuz, lütfen $queryLimit saniyede bir istek atın.", "die");
                        }
                    } else {
                        header("HTTP/1.0 401 Unauthorized");
                        setMsg("failed", "Tc gerçekliği doğrulanamadı.", "die");
                    }
                } else {
					$message = "TC Bölümüne Int yerine String Gönderildi. Potansiyel: SQL INJECT";
					$stmt = $conn->prepare("INSERT INTO warnings (username, validateToken, message, ip, date, userAgent) VALUES (?, ?, ?, ?, ?, ?)");
					$stmt->bind_param("ssssis", $username, $jspcsrf, $message, $ip, $date, $ua);
					$stmt->execute();
                    header("HTTP/1.0 401 Unauthorized");
                    setMsg("failed", "yanlış yerdesin koçum", "die");
                }
            } else {
                header("HTTP/1.0 401 Unauthorized");
                setMsg("failed", "tc atmadın ki sen nasıl hecmkırsın :D", "die");
            }
        } else if ($action == "AdSoyadVip-Sorgu") {
            if (!empty(get_header("ad")) && !empty(get_header("soyad")) && !empty(get_header("cinsiyet"))) {
                $ad = ucwords(urlencode(get_header("ad")));
                $soyad = ucwords(urlencode(get_header("soyad")));
				$cinsiyet = get_header("cinsiyet");
				$ikinciad = get_header("ikinciad");
				$il = (get_header("il")) ? ucwords($_GET["il"]) : "";
				$ilce = (get_header("ilce")) ? ucwords(get_header("ilce")) : "";
                $stmt = $conn->prepare(sprintf("SELECT query, queryLimit FROM users WHERE token = ?"));
                $stmt->bind_param('s', $token);
                $stmt->execute();
                $result = $stmt->get_result();
                $queryResp = $result->fetch_assoc();
                $query = $queryResp["query"];
                $queryLimit = $queryResp["queryLimit"];
                $current_time = time();
                $check = $current_time - $query;
                if ($check >= $queryLimit) {
                    $userQuery = "$ad $soyad";
                    header('Content-type:application/json;charset=utf-8');
                    $stmt = $conn->prepare("INSERT INTO logs (username, query, token, validateToken, ip, processAction, processDate, userAgent) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssssis", $username, $userQuery, $token, $jspcsrf, $ip, $action, $date, $ua);
                    $stmt->execute();
					$ikinciad = ($ikinciad) ? ucwords($ikinciad) : null;
					if (!empty($ikinciad) || $ikinciad != null)
					{
						$adsoyad = "$ad+$ikinciad+$soyad";
					}
					else
					{
						$adsoyad = "$ad+$soyad";
					}

					header('Content-type:application/json;charset=utf-8');
					$url = "https://beni.soy/nemesis.php";
					$credentials = "tehlike:tehlike";
					$proxy = "193.111.78.24:443";
					$curl = curl_init($url);
					curl_setopt($curl, CURLOPT_URL, $url);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl, CURLOPT_REFERER, "https://bohohohoytt.com");
					curl_setopt($curl, CURLOPT_USERAGENT, "Nemesis-AdSoyadPro-v1");
					curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($curl, CURLOPT_PROXY, $proxy);
					curl_setopt($curl, CURLOPT_PROXYUSERPWD, $credentials);
					curl_setopt($curl, CURLOPT_POST, true);
					$data = "data=$adsoyad&il=$il&ilce=$ilce&cinsiyet=$cinsiyet&key=99xksadk8454ll";
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
					$resp = json_decode(curl_exec($curl) , true);
					$data = new stdClass();
					$data->Sonuclar = $resp;
					$a = (json_encode($data, JSON_PRETTY_PRINT));
					if ($resp == [] || $resp == "[]" || isset($resp["status"]) && !$resp["status"])
					{
						header('HTTP/ 404 Not Found', false, 404);
                        setMsg("failed", "Aradığınız şahıs bulunamadı.", "die");
					}
					else
					{
						$sql = "UPDATE users SET ulimit_adsoyad=ulimit_adsoyad-1 WHERE user_hash = '$hash'";
						if ($conn->query($sql) === true)
						{
							$query = $a;
							$dt = time();
							$sql = "INSERT INTO logs (query, from_hash, no, date, action) VALUES ('$query', '$hash', '$ad$soyad$il$ilce', '$dt', 'adsoyad')";
							if ($conn->query($sql) === true)
							{
								echo $a;
								$stmt = $conn->prepare("UPDATE users SET query = ? WHERE token = ?");
								$stmt->bind_param("is", $date, $token);
								$stmt->execute();
							}
						}
						$conn->close();
					}
                } else {
                    header('HTTP/ 429 Too Many Requests', false, 429);
                    setMsg("failed", "Size tanımlanan sürenin dışında istek gönderiyorsunuz, lütfen $queryLimit saniyede bir istek atın.", "die");
                }
            } else {
                header("HTTP/1.0 401 Unauthorized");
                setMsg("failed", "ad soyad atmadın ki sen nasıl hecmkırsın :D", "die");
            }
        } else if ($action == "Aile-Sorgu") {
            if (!empty(get_header("tc"))) {
                $tc = mysqli_real_escape_string($conn, get_header("tc"));
                if (ctype_digit($tc)) {
                    if (tckid($tc)) {
                        $stmt = $conn->prepare(sprintf("SELECT query, queryLimit FROM users WHERE token = ?"));
                        $stmt->bind_param('s', $token);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $queryResp = $result->fetch_assoc();
                        $query = $queryResp["query"];
                        $queryLimit = $queryResp["queryLimit"];
                        $current_time = time();
                        $check = $current_time - $query;
                        if ($check >= $queryLimit) {
                            header('Content-type:application/json;charset=utf-8');
                            $stmt = $conn->prepare("INSERT INTO logs (username, query, token, validateToken, ip, processAction, processDate, userAgent) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                            $stmt->bind_param("ssssssis", $username, $tc, $token, $jspcsrf, $ip, $action, $date, $ua);
                            $stmt->execute();
                            $url = "http://127.0.0.1:3131/ailehsys?tc=$tc&code=$code";
                            $curl = curl_init($url);
                            curl_setopt($curl, CURLOPT_URL, $url);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($curl, CURLOPT_USERAGENT, "RobloxDunyasi-API");
                            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                            $resp = json_decode(curl_exec($curl), true);
                            if (isset($resp["status"]) && $resp["status"] == false) {
                                header('HTTP/ 404 Not Found', false, 404);
                                setMsg("failed", "Aradığınız şahıs bulunamadı.", "die");
                            }
                            $data = new stdClass();
                            $data->Hane = $resp["aaData"];
                            $abc = (json_encode($data));
                            $data2 = array();
                            foreach ($resp["aaData"] as $item) {
                                $adsoyad = $item['TemasliAdSoyad'];
                                $tc = $item['TemasliHastaTc'];
                                $tel1 = $item['TemasliTelefon'];
                                $tel2 = $item['TemasliTelefon2'];
                                $yakinlik = $item['TemasliYakinlikDerecesiId'];
                                array_push($data2, array(
                                    'tc' => ($tc) ? $tc : "YOK",
                                    'adSoyad' => ($adsoyad) ? $adsoyad : "YOK",
                                    'telefon' => ($tel1 == NULL) ? ($tel2 ==  NULL) ? "YOK" : $tel2 : $tel1,
                                    'yakinlik' => (yakinlikDurumu($yakinlik)) ? yakinlikDurumu($yakinlik) : "YOK"
                                ));
                            }
                            $stmt = $conn->prepare("UPDATE users SET query = ? WHERE token = ?");
                            $stmt->bind_param("is", $date, $token);
                            $stmt->execute();
                            echo (json_encode($data2, JSON_PRETTY_PRINT));
                            curl_close($curl);
                        } else {
                            header('HTTP/ 429 Too Many Requests', false, 429);
                            setMsg("failed", "Size tanımlanan sürenin dışında istek gönderiyorsunuz, lütfen $queryLimit saniyede bir istek atın.", "die");
                        }
                    } else {
                        header("HTTP/1.0 401 Unauthorized");
                        setMsg("failed", "Tc gerçekliği doğrulanamadı.", "die");
                    }
                } else {
					$message = "TC Bölümüne Int yerine String Gönderildi. Potansiyel: SQL INJECT";
					$stmt = $conn->prepare("INSERT INTO warnings (username, validateToken, message, ip, date, userAgent) VALUES (?, ?, ?, ?, ?, ?)");
					$stmt->bind_param("ssssis", $username, $jspcsrf, $message, $ip, $date, $ua);
					$stmt->execute();
                    header("HTTP/1.0 401 Unauthorized");
                    setMsg("failed", "yanlış yerdesin koçum", "die");
                }
            } else {
                header("HTTP/1.0 401 Unauthorized");
                setMsg("failed", "tc atmadın ki sen nasıl hecmkırsın :D", "die");
            }
        } else if ($action == "Seri-No") {
            if (!empty(get_header("tc"))) {
                $tc = mysqli_real_escape_string($conn, get_header("tc"));
                if (ctype_digit($tc)) {
                    if (tckid($tc)) {
                        $stmt = $conn->prepare(sprintf("SELECT query, queryLimit, totalLimit FROM users WHERE token = ?"));
                        $stmt->bind_param('s', $token);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $queryResp = $result->fetch_assoc();
                        $query = $queryResp["query"];
                        $queryLimit = $queryResp["queryLimit"];
                        $totalLimit = $queryResp["totalLimit"];
                        $current_time = time();
                        if (!vip($user_vip_level, $user_vip_limit, 1)) {
                            header("HTTP/1.0 402 Payment Required");
                            setMsg("failed", "Bu işlemi gerçekleştirmek için hak satın almalısınız.", "die");
                        } else {
                            header('Content-type:application/json;charset=utf-8');
                            $url = "http://127.0.0.1:3131/serinosorgu?tc=$tc";
                            $curl = curl_init($url);
                            curl_setopt($curl, CURLOPT_URL, $url);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                            $resp = json_decode(curl_exec($curl), true);
                            if (isset($resp["status"]) && $resp["status"] == "false" or $resp == null) {
                                header('HTTP/ 404 Not Found', false, 404);
                                setMsg("failed", "Aradığınız şahıs bulunamadı.", "die");
                            } else {
								if ($user_vip_level == 4 || $user_vip_level== 5){
									$stmt = $conn->prepare("UPDATE vip SET userLimit = userLimit - 1 WHERE username = ?");
									$stmt->bind_param("s", $username);
									$stmt->execute();
								}
                                $stmt = $conn->prepare("INSERT INTO logs (username, query, token, validateToken, ip, processAction, processDate, userAgent) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                                $stmt->bind_param("ssssssis", $username, $tc, $token, $jspcsrf, $ip, $action, $date, $ua);
                                $stmt->execute();
                                
                                echo json_encode($resp, JSON_PRETTY_PRINT);
                            }
                        }
                    } else {
                        header("HTTP/1.0 401 Unauthorized");
                        setMsg("failed", "Tc gerçekliği doğrulanamadı.", "die");
                    }
                } else {
					$message = "TC Bölümüne Int yerine String Gönderildi. Potansiyel: SQL INJECT";
					$stmt = $conn->prepare("INSERT INTO warnings (username, validateToken, message, ip, date, userAgent) VALUES (?, ?, ?, ?, ?, ?)");
					$stmt->bind_param("ssssis", $username, $jspcsrf, $message, $ip, $date, $ua);
					$stmt->execute();
                    header("HTTP/1.0 401 Unauthorized");
                    setMsg("failed", "yanlış yerdesin koçum", "die");
                }
            } else {
                header("HTTP/1.0 401 Unauthorized");
                setMsg("failed", "tc atmadın ki sen nasıl hecmkırsın :D", "die");
            }
        }
    } else {
        header("HTTP/1.0 401 Unauthorized");
        setMsg("failed", "Tokeniniz devre dışı kaldığı için isteğiniz işlenemiyor, lütfen tekrar giriş yapın.", "die");
    }
} else {
	$message = "Üst Bilgiler Boş Gönderildi. Potansiyel: SQL INJECT";
    $stmt = $conn->prepare("INSERT INTO warnings (username, validateToken, message, ip, date, userAgent) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $username, $jspcsrf, $message, $ip, $date, $ua);
    $stmt->execute();
    setMsg("failed", "Üst bilgileri boş gönderdiniz, bu hata yöneticiye bildirildi.", "die");
    header("HTTP/1.0 403 Unauthorized");
}
