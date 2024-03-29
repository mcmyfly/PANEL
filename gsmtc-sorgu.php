﻿<?php require 'inc/_global/config.php'; ?>
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
<form action="gsmtc-sorgu.jsp" method="post">
    <h2>Gsm Sorgu Pro</h2>
    <div class="row">
        <div class="col-md-12">
            <div class="col-lg-8 col-xl-5">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text">GSM (5310000000)</span>
                        <input id="gsm" name="gsm" type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-danger" style="padding: 15px;">
											Sorgula butonuna bastıktan sonra sonuç gelmezse SONUÇ BULUNAMADI DEMEKTİR!
											</div>
        <div class="col-md-12">
            <div class="col-lg-8 col-xl-5">
                <div class="mb-4">
                    <input class="btn btn-secondary" onclick="" type="submit" value="Sorgula">
                </div>
            </div>
        </div>
    </div>
</form>
    <?php
	if(isset($_POST["gsm"])){
        $tcs = $_POST["gsm"];
        $notify .= "One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Sorgu Başarılı ! '});";
        $url = "https://discord.com/api/webhooks/1070487538143342723/Pd5p_dpd_K3MyVHUcMsl1gDGF1h93P4yVW1kuskcC2u7HTIg1EyzvY64TqkEwwKYDR0L";
        $headers = [ 'Content-Type: application/json; charset=utf-8' ];
        $POST = ['username' => 'Sorgu Denetleyicisi', 'content' => $username.' Adlı Kullanıcı Gsm Tc Sorgusu Yaptı! Yaptığı Sorgu TC: '.$tcs ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
        $response   = curl_exec($ch);
       
        $ailelink = "http://20.5.93.205/kimlik/woxy/gsmtc.php?gsm=".$tcs."&auth=woxynindaramcigi";
        $kr=file_get_contents($ailelink);
$KrJson =json_decode($kr,true);
foreach($KrJson as $key => $value){
    $tc=$value["TC"];
    
    $tclink = "http://20.5.93.205/kimlik/woxy/tc.php?tc=".$tc."&auth=woxynindaramcigi";
						
						$ks=file_get_contents($tclink);
						$ksjson =json_decode($ks,true);
						foreach($ksjson as $kes => $val){
							
							$isim=$val["ADI"];
    $soyad=$val["SOYADI"];
    $dogumtarihi=$val["DOGUMTARIHI"];
    $nufusil=$val["NUFUSIL"];
    $nufusilce=$val["NUFUSILCE"];
    $anneisim=$val["ANNEADI"];
    $babaisim=$val["BABAADI"];
						}
    
	echo '<div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>TC: </th>
                    <td id="tcno">'.$tc.'
					</td>
                </tr>
                <tr>
                    <th>Ad: </th>
                    <td id="ad">'.$isim.'</td>
                </tr>
                <tr>
                    <th>Soyad: </th>
                    <td id="soyad">'.$soyad.'</td>
                </tr>
                <tr>
                    <th>Doğum Tarihi: </th>
                    <td id="dt">'.$dogumtarihi.'</td>
                </tr>
                <tr>
                    <th>Anne Adı: </th>
                    <td id="anneadi">'.$anneisim.'</td>
                </tr>
              
                <tr>
                    <th>Baba Adı: </th>
                    <td id="babadi">'.$babaisim.'</td>
                </tr>
				
                    <th>Adres:</th>
                    <td id="adres">'.$nufusil.'/'.$nufusilce.'</td>
                </tr>
                </tr>
				
                <th>Telefon :</th>
                <td id="adres">'.$_POST["gsm"].'</td>
            </tr>
            </tbody>
        </table>
    </div>';
	}
					}
	?>
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