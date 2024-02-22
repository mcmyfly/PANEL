<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/user.php'; ?>
<?php require 'inc/_global/token.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>
<style>
table.table-bordered>tbody>tr>td {
    border: 1px solid #364054;
}

table.table-bordered>tbody>tr>th {
    border: 1px solid #364054;
}
</style>
<div class="content">
    <h2>Data Düzenle</h2>
	<form id="duzenle" method="POST">
		<div class="row">
        <div class="col-md-12">
            <div class="col-lg-12 col-xl-12">
                <div class="mb-4">
                    <textarea style="margin: ;min-height: 200px;" class="form-control form-control-lg mb-3" rows="1"name="list" id="tduzenle"></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-lg-8 col-xl-5">
                <div class="mb-4">
					<button class="btn btn-secondary" type="submit" name="liste">Düzenle</button>
                </div>
            </div>
        </div>
    </div>
	</form>
</div>

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php $one->get_js('js/lib/jquery.min.js'); ?>
<?php $one->get_js('js/plugins/jquery-validation/jquery.validate.min.js'); ?>
<?php $one->get_js('js/pages/op_auth_signin.min.js'); ?>
<script>
var request;
$("#duzenle").submit(function(event){
    event.preventDefault();

    if (request) {
        request.abort();
    }

    var $form = $(this);
    var $inputs = $form.find("button, textarea");
    var datas;
    var serializedData = $form.serialize();

    $inputs.prop("disabled", true);
    request = $.ajax({
        url: "api/duzenle.jsp",
        type: "post",
        data: serializedData,
		headers: {
            'JspCsrf': '<?= token($sessionExpire) ?>',
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
			} else if (status == 402) {
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

    request.done(function (response){
    response=jQuery.parseJSON(response);
	const say = response['say'];
	const gon = response['gon'];
	One.helpers('jq-notify', {
		type: 'success',
		icon: 'fa fa-check me-1',
		message: `Giden: ${say} Gelen: ${gon}`
	});
    $("#tduzenle").val(response['data']);
    });

    request.fail(function (jqXHR, textStatus, errorThrown){
        $('.notifyjs-corner').empty();
        One.helpers('jq-notify', {
            type: 'danger',
            icon: 'fa fa-times me-1',
            message: "Data boyutu çok büyük."
        });
    });

    request.always(function () {
        $inputs.prop("disabled", false);
    });

});
</script>
<?php require 'inc/_global/views/footer_end.php'; ?>