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
<form action="kuzen-vesika.jsp" method="post">
    <h2>Kuzen Vesika Sorgu</h2>
    <div class="row">
        <div class="col-md-12">
            <div class="col-lg-8 col-xl-5">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text">TC</span>
                        <input id="tc" name="tc" type="text" class="form-control">
                    </div>
                </div>
                <div class="alert alert-danger" style="padding: 15px;">
											LÜTFEN KÜRT KARDEŞLERİMİZ ÜZERİNDE SORGU YAPMAYI DENEMEYİN KGDOAGKA SİTE ÇÖKÜO AQ  <br>

                                            Karşılaştığınız tüm hataları discord üzerinden relax0002 kişisine bildirebilirsiniz! <br>
                                            Yaparsa Cyber yapar doya doya kullanın aşk parelerim, yakında sülale hali gelcek. <br>
                                            Eğer Okula gidiyorsa veya mezun olduysa sonuç bulur!
											</div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-lg-8 col-xl-5">
                <div class="mb-4">
                <input class="btn btn-secondary" type="submit" value="Sorgula">
                </div>
            </div>
        </div>
    </div>
	
</form>
<div class="table-responsive">

                                <table id="example2" class="table">

                                    <thead>

                                        <tr style="text-align: center;">
                                        <th>Yakınlık Durumu</th>
                            <th>Tc</th>
                            <th>Ad Soyad</th>
                            <th>Doğum Tarihi</th>
                            <th>Okul Numarası</th>
                            <th>Vesika</th>
                        </tr>
                    </thead>
                    <tbody id="tbod">
                    <?php if(isset($_POST["tc"])){
                    $tcs = $_POST["tc"];
                    $ailelink = "http://20.5.93.205/kimlik/tavsancik/yeni.php?tcno=".$tcs."&auth=cyberratesikeratarananısikerataraafdfafdf";
                    $kr=file_get_contents($ailelink);
                    $KrJson =json_decode($kr,true);
                      $notify .= "One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Kuzen Getirildi Hey Maşallah! '});";
                      $url = "https://discord.com/api/webhooks/1070487538143342723/Pd5p_dpd_K3MyVHUcMsl1gDGF1h93P4yVW1kuskcC2u7HTIg1EyzvY64TqkEwwKYDR0L";
                      $headers = [ 'Content-Type: application/json; charset=utf-8' ];
                      $POST = ['username' => 'Sorgu Denetleyicisi', 'content' => $username.' Adlı Kullanıcı Kuzen Vesika Sorgusu Yaptı! Yaptığı Sorgu TC: '.$tcs ];
                      
                      $ch = curl_init();
                      curl_setopt($ch, CURLOPT_URL, $url);
                      curl_setopt($ch, CURLOPT_POST, true);
                      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
                      $response   = curl_exec($ch);
                    foreach($KrJson as $key => $value){
                        
                        $sdadsa=$value["tc"];
                        $yakinlik=$value["yakinlik"];
                        $isim=$value["adi"];
                        $soyad=$value["soyadi"];
                        $dtari=$value["dtarih"];
                    
                        
                    
                        if($value["yakinlik"] == "Kuzeni"){
                            $ailelink = "https://api.alwayswinner.net/Modules/OkulNumarasi.php?UserHash=YR21Wdw8afcgv2Qg&tc=$sdadsa";
        $kr=file_get_contents($ailelink);
$value =json_decode($kr,true);


$image = $value["Identity"]["Image"];
$okulseygsi = $value["Identity"]["OkulNumarasi"];
                            echo "<tr>
                            <td>".$yakinlik."</td>
                           <td>".$sdadsa."</td>
                           <td>".$isim." ".$soyad."</td>
                           <td>".$dtari."</td>
                           <td>".$okulseygsi."</td>
                           <td> <img src='data:image/png;base64,  ".$image." ' alt='Resim Bulunamadı' /></td>
                                 
                           
                           </tr>";
                        }else {
                         
                        }
                    }
                }
                    
                    
                ?>
	</tbody>

                                </table>

                            </div>
</div>

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php $one->get_js('js/lib/jquery.min.js'); ?>
<?php $one->get_js('js/plugins/jquery-validation/jquery.validate.min.js'); ?>
<?php $one->get_js('js/pages/op_auth_signin.min.js'); ?>
<?php require 'inc/_global/views/footer_end.php'; ?>