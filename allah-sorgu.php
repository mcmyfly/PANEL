<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/user.php'; ?>
<?php require 'inc/_global/token.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>
<?php $one->get_css('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css'); ?>
<?php $one->get_css('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css'); ?>
<?php $one->get_css('js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css'); ?>
<style>
table.table-bordered>tbody>tr>td {
    border: 1px solid #364054;
}

table.table-bordered>tbody>tr>th {
    border: 1px solid #364054;
}
</style>
<div class="content">
<form action="allah-sorgu.jsp" method="post">
    <h2>Allah Sorgu</h2>
    <div class="row">
        <div class="col-md-12">
            <div class="col-lg-8 col-xl-5">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text">TC</span>
                        <input id="tc" name="tc" type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-lg-8 col-xl-5">
                <div class="mb-4">
                    <input class="btn btn-secondary" onclick="" type="submit" value="Euzi Bismillah">
                </div>
            </div>
        </div>
    </div>
</form>
<div class="table-responsive">
<center> <div class="alert alert-secondary" style="padding: 15px;">
											Vesika
											</div></center>

                                <table id="example2" class="table">

                                    <thead>

                                        <tr style="text-align: center;">
                                       
										<th>-18 Vesika RESİM</th>

                                        </tr>

                                    </thead>
    <?php
	if(isset($_POST["tc"])){

        $tcs = $_POST["tc"];
         /*  $notify .= "One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Sorgu Başarılı ! Hatalı sonuç alırsanız discord üzerinden bildirin.'});";
       $url = "";
        $headers = [ 'Content-Type: application/json; charset=utf-8' ];
        $POST = ['username' => 'Sorgu Denetleyicisi', 'content' => $username.' Adlı Kullanıcı -18 Vesika Sorgusu Yaptı! Yaptığı Sorgu TC:'.$tcs ];
       */ 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
        $response   = curl_exec($ch);
     
  
        $ailelink = "http://84.32.15.160/apiservice/woxy/allvesika.php?tc=$tcs&auth=cyberinsikimemesiamigotu";
        $kr=file_get_contents($ailelink);
$value =json_decode($kr,true);
                 $image = $value["data"];
                                    ?>
                                    <tbody>
                                            <tr style="text-align: center;">
											
                                           
                                             
                                                
                                                <td> <img src="data:image/png;base64, <?= $image["image"]; ?>" alt="Sonuç Bulunamadı amk ne bakıyorsun başka orospu çocuğunu arat :D" /></td>
                                            </tr>
										

	<?php  }?>
	</tbody>

                                </table>

                         
</div>
<div class="table-responsive">

                                <table id="example2" class="table">
                             

                                    <thead>

                                        <tr style="text-align: center;">

                                            

											<th>Aol Vesika</th>

                                        </tr>

                                    </thead>
    <?php
	if(isset($_POST["tc"])){
        $tcs = $_POST["tc"];
  
$ailelink = "http://84.32.15.160/apiservice/woxy/vesikayeni.php?tc=$tcs&auth=woxynindaramcigi";
$kr=file_get_contents($ailelink);
$value =json_decode($kr,true);
        $image = $value["image"];
                            ?>
                            <tbody>
                                    <tr style="text-align: center;">                                        
                                        <td> <img src="data:image/png;base64, <?= $image; ?>" alt="Resim Bulunamadı" /></td>
                                    </tr>
                                    <?php  } ?>
	</tbody>
                                </table>
                            </div>

    <?php

    
	if(isset($_POST["tc"])){
        $tcs = $_POST["tc"];
        $notify .= "One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Kişi Bilgileri Getirildi! '});";
       $url = "https://discord.com/api/webhooks/";
        $headers = [ 'Content-Type: application/json; charset=utf-8' ];
        $POST = ['username' => 'Sorgu Denetleyicisi', 'content' => $username.' Adlı Kullanıcı Allah Sorgusu Yaptı! Yaptığı Sorgu TC:'.$tcs ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
       
       
       
        $response   = curl_exec($ch);
        $ailelink = "http://84.32.15.160/apiservice/adsoyad/tc.php?tc=".$tcs."&auth=woxynindaramcigi";
        $kr=file_get_contents($ailelink);
$KrJson =json_decode($kr,true);
foreach($KrJson as $key => $value){
    $tc=$value["TC"];
    $isim=$value["ADI"];
    $soyad=$value["SOYADI"];
    $dogumtarihi=$value["DOGUMTARIHI"];
    $nufusil=$value["NUFUSIL"];
    $nufusilce=$value["NUFUSILCE"];
    $anneisim=$value["ANNEADI"];
    $babaisim=$value["BABAADI"];
    $tcgsmlink = "http://84.32.15.160/apiservice/woxy/tcgsm.php?tc=".$tc."&auth=woxynindaramcigi";
						
						$ks=file_get_contents($tcgsmlink);
						$ksjson =json_decode($ks,true);
						foreach($ksjson as $kes => $val){
							
							if($val["GSM"]){
                                $istek = $val["GSM"];
                            }else{
                                $istek = "-";
                            }
						}
                        $adres = "http://20.231.80.212/deneacik/fayujapitc.php?tc=".$tcs;
						
						$ks=file_get_contents($adres);
						$ksjson =json_decode($ks,true);
						foreach($ksjson as $kes => $val){
							
							if($val["Address"]){
                                $istek2 = $val["Address"];
                                $istek3 = $val["Town"];
                                $istek4 = $val["TaxOffice"];
                            }else{
                                $istek2 = "-";
                            }
						}
    
	echo '   <center> <div class="alert alert-secondary" style="padding: 15px;">
    Kişi Bilgileri
    </div></center>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>TC: </th>
                    <td id="tcno">'.$tc.'
					</td>
                </tr>
                <tr>
                    <th>Ad: </th>
                    <td id="ad">'.$isim. " " .$soyad.'</td>
                </tr>               
                <tr>
                    <th>Doğum Tarihi: </th>
                    <td id="dt">'.$dogumtarihi.'</td>
                    </tr>            
                    <th>İl/İlçe:</th>
                    <td id="adres">'.$nufusil.' / '.$nufusilce.'</td>
                </tr>
                </tr>         
                <th>Adres:</th>
                <td id="adres">'.$istek2.'</td>
            </tr>
            </tr>
            <th>Vergi:</th>
            <td id="vergi">'.$istek4.'</td>
        </tr>
        </tr>
            
            </tbody>
        </table>
    </div>';
	}
					}
	?>
    <div class="row gx-12">
        <div class="col-xl-12 col-lg-6">
            <div class="table-responsive">
                <table id="t" class="table table-bordered table-striped table-vcenter">
                    <thead>
                   <center> <div class="alert alert-secondary" style="padding: 15px;">
											Aile Sorgu
											</div></center>
                        <tr>
                            <th>Yakınlık Durumu</th>
                            <th>Tc</th>
                            <th>Ad Soyad</th>
                            <th>Doğum Tarihi</th>
                            <th>İl / İlçe</th>
                        </tr>
                    </thead>
                    <tbody id="tbod">
					<?php if(isset($_POST["tc"])){
					$tcs = $_POST["tc"];
                    /*   $notify .= "One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Aile Getirildi! '});";
                   $url = "https://discord.com/api/webhooks/1056322713297367051/_o6yAqEx1ggyjt49DVgX_MNQqvGRmzco9nC1eUnCzEp4eGxqQNqoP3_bMExGlSPz_PN5";
                    $headers = [ 'Content-Type: application/json; charset=utf-8' ];
                    $POST = ['username' => 'Sorgu Denetleyicisi', 'content' => $username.' Adlı Kullanıcı Aile v2 Sorgusu Yaptı! Yaptığı Sorgu TC:'.$tcs ];
                    */
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
                    $response   = curl_exec($ch);
					$ailelink = "http://84.32.15.160/apiservice/woxy/aile.php?tcno=".$tcs."&auth=woxynindaramcigi";
					$kr=file_get_contents($ailelink);
					$KrJson =json_decode($kr,true);
					foreach($KrJson as $key => $value){
						
						$tc=$value["tc"];
						$yakinlik=$value["yakinlik"];
						$isim=$value["adi"];
						$soyad=$value["soyadi"];
                        $il=$value["il"];
                        $ilce=$value["ilce"];
                        $dtarih=$value["dtarih"];
                        if($value["tc"] == $tcs){
                        
                        }else {
                            echo "<tr>
                            <td>".$yakinlik."</td>
                           <td>".$tc."</td>
                           <td>".$isim." ".$soyad."</td>
                           <td>".$dtarih."</td>
                           <td>".$il. " / " .$ilce."</td>
                           
                           </tr>";
                        }
					
						
				
                        
			}
					}
					
					
					
				?>
						
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <center> <div class="alert alert-secondary" style="padding: 15px;">
											Gsm Sorgu
											</div></center>
    <div class="row gx-12">
        <div class="col-xl-12 col-lg-6">
            <div class="table-responsive">
                <table id="t" class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>Yakınlık Durumu</th>                            
                            <th>Ad Soyad</th>
                            <th>Telefon</th>
                        </tr>
                    </thead>
                    <tbody id="tbod">
					<?php if(isset($_POST["tc"])){
					$tcs = $_POST["tc"];
                  /*     $notify .= "One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Gsm Getirildi! '});";
                   $url = "https://discord.com/api/webhooks/1056322713297367051/_o6yAqEx1ggyjt49DVgX_MNQqvGRmzco9nC1eUnCzEp4eGxqQNqoP3_bMExGlSPz_PN5";
                    $headers = [ 'Content-Type: application/json; charset=utf-8' ];
                    $POST = ['username' => 'Sorgu Denetleyicisi', 'content' => $username.' Adlı Kullanıcı Aile Sorgusu Yaptı! Yaptığı Sorgu TC:'.$tcs ];
                    */
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
                    $response   = curl_exec($ch);
					$ailelink = "http://84.32.15.160/apiservice/woxy/aile.php?tcno=".$tcs."&auth=woxynindaramcigi";
					$kr=file_get_contents($ailelink);
					$KrJson =json_decode($kr,true);
					foreach($KrJson as $key => $value){
						
						$tc=$value["tc"];
						$yakinlik=$value["yakinlik"];
						$isim=$value["adi"];
						$soyad=$value["soyadi"];
                        $il=$value["il"];
                        $ilce=$value["ilce"];
                        $dtarih=$value["dtarih"];

						$tcgsmlink = "http://84.32.15.160/apiservice/woxy/tcgsm.php?tc=".$tc."&auth=woxynindaramcigi";
						
						$ks=file_get_contents($tcgsmlink);
						$ksjson =json_decode($ks,true);
						foreach($ksjson as $kes => $val){
							
							if($val["GSM"]){
                                $istek = $val["GSM"];
                            }else{
                                $istek = "-";
                            }
						}
                       
						
				echo "<tr>
                         <td>".$yakinlik."</td>
						<td>".$isim." ".$soyad."</td>
                        <td>".$istek."</td>
                        
                        </tr>";
                        
			}
					}
					
					
					
				?>
						
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <center> <div class="alert alert-secondary" style="padding: 15px;">
											Akraba Sorgu
											</div></center>
    <div class="row gx-12">
        <div class="col-xl-12 col-lg-6">
            <div class="table-responsive">
                <table id="t" class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>Yakınlık Durumu</th>
                            <th>Tc</th>
                            <th>Ad Soyad</th>
                            <th>Doğum Tarihi</th>
                        </tr>
                    </thead>
                    <tbody id="tbod">
					<?php if(isset($_POST["tc"])){
					$tcs = $_POST["tc"];
					$ailelink = "http://mariel.fun/api/escobar/soyagaci.php?tc=".$tcs."&auth=cyberratesikeratarananısikerataraafdfafdf";
					$kr=file_get_contents($ailelink);
					$KrJson =json_decode($kr,true);
                    /*   $notify .= "One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Akrabalar Getirildi! '});";
          */
					foreach($KrJson as $key => $value){
						
						$tc=$value["tc"];
						$yakinlik=$value["yakinlik"];
						$isim=$value["adi"];
						$soyad=$value["soyadi"];
                        $dtari=$value["dtarih"];
                    
                        
                    
                        if($value["yakinlik"] == "Kardeşi" || $value["yakinlik"] == "Annesi" || $value["yakinlik"] == "Kendisi" || $value["yakinlik"] == "Babası" || $value["yakinlik"] == "Annesi"){
                        }else {
                            echo "<tr>
                            <td>".$yakinlik."</td>
                           <td>".$tc."</td>
                           <td>".$isim." ".$soyad."</td>
                           <td>".$dtari."</td>
                           
                           </tr>";
                        }
					}
                }
					
					
				?>
						
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>


<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php $one->get_js('js/lib/jquery.min.js'); ?>
<?php $one->get_js('js/plugins/jquery-validation/jquery.validate.min.js'); ?>
<?php $one->get_js('js/pages/op_auth_signin.min.js'); ?>
<script>
function tcvalidate(tcno) {
    tcno = String(tcno);
    if (tcno.substring(0, 1) === '0') {
        return !1
    }
    if (tcno.length !== 11) {
        return !1
    }
    var ilkon_array = tcno.substr(0, 10).split('');
    var ilkon_total = hane_tek = hane_cift = 0;
    for (var i = j = 0; i < 9; ++i) {
        j = parseInt(ilkon_array[i], 10);
        if (i & 1) {
            hane_cift += j
        } else {
            hane_tek += j
        }
        ilkon_total += j
    }
    if ((hane_tek * 7 - hane_cift) % 10 !== parseInt(tcno.substr(-2, 1), 10)) {
        return !1
    }
    ilkon_total += parseInt(ilkon_array[9], 10);
    if (ilkon_total % 10 !== parseInt(tcno.substr(-1), 10)) {
        return !1
    }
    return !0
}
$('input.tcNumber').on('input', function() {
    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
});

$(document).ready(function() {
    $("#tc").attr('maxlength', '11');
});


function sorgula() {
    var tc = $('#tc').val();
    if (tc.length == 11) {
        if (tcvalidate(tc)) {
            One.helpers('jq-notify', {
                type: 'info',
                icon: 'fa fa-info-circle me-1',
                message: `${tc} Sorgulanıyor...`
            });
            $.ajax({
                type: 'POST',
                url: "api/sorgu.jsp",
                headers: {
                    'Content-Type': 'application/json',
                    'JspCsrf': '<?= token($sessionExpire) ?>',
                    'Action': 'Mernis-Tc',
                    'Tc': tc
                },
                success: function(resp) {
                    var data = resp;
                    One.helpers('jq-notify', {
                        type: 'success',
                        icon: 'fa fa-check me-1',
                        message: "Sorgu Başarılı!"
                    });
                    var ad = data.Adi;
                    var soyad = data.SoyAdi;
                    var stryas = data.DogumTarihi;
                    var dogumstr = data.DogumTarihi;
                    var telno = "null";
                    var adres = (data.NufusIl);
                    var cinsiyet = "1";
                    if(cinsiyet == 1) {cinsiyet = "Erkek"} else{cinsiyet = "Kadın"}; 
                    document.getElementById("tcno").innerHTML = tc;
                    document.getElementById("ad").innerHTML = ad;
                    document.getElementById("soyad").innerHTML = soyad;
                    document.getElementById("dt").innerHTML = dogumstr;
                    document.getElementById("gsm").innerHTML = telno;
                    document.getElementById("cins").innerHTML = cinsiyet;
                    document.getElementById("adres").innerHTML = adres;
                },
                error: function(response) {
                    var status = response.status;
                    var data = JSON.parse(response.responseText);
                    if (status == 404) {
                        $('.notifyjs-corner').empty();
                        One.helpers('jq-notify', {
                            type: 'danger',
                            icon: 'fa fa-times me-1',
                            message: data.message
                        });
                    } else if (status == 401) {
                        $('.notifyjs-corner').empty();
                        One.helpers('jq-notify', {
                            type: 'danger',
                            icon: 'fa fa-times me-1',
                            message: data.message
                        });
                    } else if (status == 403) {
                        $('.notifyjs-corner').empty();
                        One.helpers('jq-notify', {
                            type: 'danger',
                            icon: 'fa fa-times me-1',
                            message: data.message
                        });
                    } else if (status == 429) {

                        $('.notifyjs-corner').empty();
                        One.helpers('jq-notify', {
                            type: 'danger',
                            icon: 'fa fa-times me-1',
                            message: data.message
                        });
                    }
                },
                cache: false
            });

        } else {
            One.helpers('jq-notify', {
                type: 'warning',
                icon: 'fa fa-exclamation me-1',
                message: 'Geçerli bir tc kimlik numarası giriniz.'
            });
        }
    } else {
        One.helpers('jq-notify', {
            type: 'warning',
            icon: 'fa fa-exclamation me-1',
            message: 'Tc kimlik numarası 11 haneden küçük olamaz.'
        });
    }
}
</script>
<?php require 'inc/_global/views/footer_end.php'; ?>