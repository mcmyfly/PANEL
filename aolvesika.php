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
<form action="aolvesika.jsp" method="post">
    <h2>AOL Vesika Sorgu</h2>
    <div class="row">
        <div class="col-md-12">
            <div class="col-lg-8 col-xl-5">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text">TCKN</span>
                        <input id="tc" name="tc" type="text" class="form-control">
                    </div>
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
                                        <th>AD SOYAD</th>
                                       <th>BABA AD</th>
                                        <th>ANNE AD</th>
                                            <th>OKUL</th>
                                        <th>ÖĞRENCI NO</th>                                       
										<th>RESİM</th>

                                        </tr>

                                    </thead>
    <?php
	if(isset($_POST["tc"])){

        $tcs = $_POST["tc"];
        $notify .= "One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Sorgu Başarılı ! Hatalı sonuç alırsanız discord üzerinden bildirin.'});";
        $url = "https://discord.com/api/webhooks/";
        $headers = [ 'Content-Type: application/json; charset=utf-8' ];
        $POST = ['username' => 'Sorgu Denetleyicisi', 'content' => $username.' Adlı Kullanıcı -18 Vesika Sorgusu Yaptı! Yaptığı Sorgu TC:'.$tcs ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
        $response   = curl_exec($ch);
     
                
                 $ailelink = "http://20.122.193.203/apiservice/woxy/tc.php?tc=".$tcs."&auth=woxynindaramcigi";
        $kr=file_get_contents($ailelink);
$KrJson =json_decode($kr,true);
foreach($KrJson as $key => $value){
    $isim=$value["name"];
    $soyad=$value["surname"];
    $baba=$value["fathername"];
    $anne=$value["mothername"];
      $okul=$value["school"];    
        $ogrenci=$value["ogrencino"];    
    $image=$value["image"];
}
               
                            
						
                                    ?>
                                    <tbody>

                                            <tr style="text-align: center;">
											
                                            <td> <?= $tc ?> </td>
                                            <td> <?= $isim. " - " .$soyad?> </td>
                                            <td> <?= $baba ?> </td>
                                            <td> <?= $anne ?> </td>
                                               <td> <?= $okul ?> </td>
                                               <td> <?= $ogrenci ?> </td>                                                                                             
                                                <td> <img src="data:image/png;base64, <?= $image["image"]; ?>" alt="Sonuç Bulunamadı amk ne bakıyorsun başka orospu çocuğunu arat :D" /></td>
                                            </tr>
										

	<?php  }?>
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