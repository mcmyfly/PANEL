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
<form action="aolsorgu.jsp" method="post">
    <h2>Aöl Sorgu</h2>
    <div class="row">
        <div class="col-md-12">
            <div class="col-lg-8 col-xl-5">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text">TC</span>
                        <input id="tc" name="tc" type="text" class="form-control">
                    </div>
                </div>
                <div class="alert alert-success" style="padding: 15px;">
											RelaX İyi Kullanımlar Diler.
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
<div class="row gx-12">
        <div class="col-xl-12 col-lg-6">
        <div class="table-responsive">
                <table id="example2" class="table table-bordered table-striped table-vcenter">

                <thead>

<thead>
    <tr style="text-align: center;">
	    <th>adı<th>
		<th>soyadı<th>
		<th>alan<th>
        <th>ogrencino</th>
        <th>Vesika</th>
		<th>
    </tr>
</thead>
<tbody>
    <?php
        $tc = $_POST['tc'];
        if(isset($_POST['tc'])){
            $response = file_get_contents("http://91.151.89.232/aol.php?tc=".$_POST['tc']);
            $decoded = json_decode($response, true);
			$adı = $decoded['name'];
			$soyadı = $decoded['surname'];
			$alan = $decoded['school'];
            $ogrenci = $decoded['ogrencino'];
            $image = $decoded['image'];
            $image_data = base64_decode($image); 
            $image_src = 'data:image/jpeg;base64,' . base64_encode($image_data); 
    ?>
        <tr>
		    <td><?= $adı ?></td>
		    <td><?= $soyadı ?></td>
		    <td><?= $alan ?></td>
            <td><?= $ogrenci ?></td>
            <td><img src="<?= $image_src ?>" alt="Student Photo"></td> 
        </tr>
    <?php
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