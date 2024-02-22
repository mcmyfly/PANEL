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
<form action="ailevesika-sorgu.jsp" method="post">
    <h2>Aile Vesika  Sorgu</h2>
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
											Yakın zamanda kardeşleride çıkacaktır :D
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
<center> <div class="alert alert-secondary" style="padding: 15px;">
											Kişi Vesikaları
											</div></center>

                                <table id="example2" class="table">

                                    <thead>

                                        <tr style="text-align: center;">
                                       
										<th>-18 Vesika RESİM</th>
                                        <th>A.O.L Vesika</th>

                                        </tr>

                                    </thead>
    <?php
	if(isset($_POST["tc"])){

        $tcs = $_POST["tc"];
     $notify = "One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Sorgu Başarılı ! Hatalı sonuç alırsanız discord üzerinden bildirin.'});";
       $url = "https://discord.com/api/webhooks/1070487538143342723/Pd5p_dpd_K3MyVHUcMsl1gDGF1h93P4yVW1kuskcC2u7HTIg1EyzvY64TqkEwwKYDR0L";
        $headers = [ 'Content-Type: application/json; charset=utf-8' ];
        $POST = ['username' => 'Sorgu Denetleyicisi', 'content' => $username.' Adlı Kullanıcı Aile Vesika Sorgusu Yaptı! Yaptığı Sorgu TC: '.$tcs ];
       
       
     
       $ailelink = "http://20.5.93.205/kimlik/woxy/tc.php?tc=".$tcs."&auth=woxynindaramcigi";
       $kr=file_get_contents($ailelink);
$KrJson =json_decode($kr,true);
foreach($KrJson as $key => $value){
    $kenditcsi=$value["TC"];
   $annetc=$value["ANNETC"];
   $babatc=$value["BABATC"];
}
        $ailelink = "http://20.5.93.205/kimlik/woxy/allvesika.php?tc=$tcs&auth=cyberinsikimemesiamigotu";
        $kr=file_get_contents($ailelink);
$value =json_decode($kr,true);
                 $image = $value["data"];

                 $adailelink = "http://20.5.93.205/kimlik/woxy/vesikayeni.php?tc=$kenditcsi&auth=woxynindaramcigi";
$kr=file_get_contents($adailelink);
$value =json_decode($kr,true);
$fotograf = $value["image"];
                                    ?>
                                    <tbody>
                                            <tr style="text-align: center;">
											
                                           
                                             
                                                
                                                <td> <img src="data:image/png;base64, <?= $image["image"]; ?>" alt="-18 Vesika Bulunamadı" /></td>
                                         
                                                <td> <img src="data:image/png;base64, <?= $fotograf; ?>" alt="Resim Bulunamadı" /></td>
                                           
                                            </tr>
										

	<?php  }?>
	
	</tbody>
                                </table>
                            </div>

                            	
                            </form>
<div class="table-responsive">
<center> <div class="alert alert-secondary" style="padding: 15px;">
											Anne Vesika
											</div></center>
                                <table id="example2" class="table">

                                    <thead>

                                        <tr style="text-align: center;">
                                       
										<th>Anne Vesika.</th>
                                      

                                        </tr>

                                    </thead>
    <?php
	if(isset($_POST["tc"])){

        $tcs = $_POST["tc"];
     /*   $notify .= "One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Sorgu Başarılı ! Hatalı sonuç alırsanız discord üzerinden bildirin.'});";
      */  $url = "https://discord.com/api/webhooks/1070487538143342723/Pd5p_dpd_K3MyVHUcMsl1gDGF1h93P4yVW1kuskcC2u7HTIg1EyzvY64TqkEwwKYDR0L";
        $headers = [ 'Content-Type: application/json; charset=utf-8' ];
        $POST = ['username' => 'Sorgu Denetleyicisi', 'content' => $username.' Adlı Kullanıcı Aile Vesika Sorgusu Yaptı! Yaptığı Sorgu TC: '.$tcs ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
        $response   = curl_exec($ch);
     
  
        $filename = "http://20.5.93.205/kimlik/woxy/egliyet.php?tc=$annetc&auth=cyberinsikimemesiamigotu";
        $data = file_get_contents($filename);
        $users = json_decode($data,true);

    }

    ?>
   <tbody>
        <tr style="text-align: center;">
                        <td> <img src="data:image/png;base64,  <?= $users["data"]["image"]; ?>" alt="Anne Ehliyet Vesikası Bulunamadı!" /></td>
        </tr>		
            <?php  ?>
    </tbody>
</table>
</div>
</form>
<div class="table-responsive">
<center> <div class="alert alert-secondary" style="padding: 15px;">
											Baba Vesika
											</div></center>
                                <table id="example2" class="table">

                                    <thead>

                                        <tr style="text-align: center;">
                                       
										<th>Baba Vesika.</th>
                                      

                                        </tr>

                                    </thead>
    <?php
	if(isset($_POST["tc"])){

        $tcs = $_POST["tc"];
       /* $notify .= "One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Sorgu Başarılı ! Hatalı sonuç alırsanız discord üzerinden bildirin.'});";
     $url = "https://discord.com/api/webhooks/1070487538143342723/Pd5p_dpd_K3MyVHUcMsl1gDGF1h93P4yVW1kuskcC2u7HTIg1EyzvY64TqkEwwKYDR0L";
        $headers = [ 'Content-Type: application/json; charset=utf-8' ];
        $POST = ['username' => 'Sorgu Denetleyicisi', 'content' => $username.' Adlı Kullanıcı Ehliyet Sorgusu Yaptı! Yaptığı Sorgu TC: '.$tcs ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
        $response   = curl_exec($ch);
     */
  
        $filename = "http://20.5.93.205/kimlik/woxy/egliyet.php?tc=$babatc&auth=cyberinsikimemesiamigotu";
        $data = file_get_contents($filename);
        $users = json_decode($data,true);

    }

    ?>
   <tbody>
        <tr style="text-align: center;">
                        <td> <img src="data:image/png;base64,  <?= $users["data"]["image"]; ?>" alt="Baba Ehliyet Vesikası Bulunamadı!" /></td>
        </tr>		
            <?php  ?>
    </tbody>
</table>
</div>


<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php $one->get_js('js/lib/jquery.min.js'); ?>
<?php $one->get_js('js/plugins/jquery-validation/jquery.validate.min.js'); ?>
<?php $one->get_js('js/pages/op_auth_signin.min.js'); ?>
<?php require 'inc/_global/views/footer_end.php'; ?>