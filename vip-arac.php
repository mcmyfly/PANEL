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
<h2>TC v2 & Araç Sorgu</h2>
<div class="row">
<div class="col-md-12">
<div class="mb-4">
<div class="alert alert-dark alert-dismissible fade show" role="alert">
Sorgu Sonucu '10' Saniye İçerisinde Gerçekleştirilmektedir. Üst Üstte İstek Atmayın. Bu Sistem Araç Sorgu v2 Olarak Sistem Yoğunluna Göre Sizler İçin Sunulmuştur..
</div>
</div>
<div class="col-lg-8 col-xl-5">
<div class="mb-4">
<div class="input-group">
<span class="input-group-text">TC</span>
<input id="tc" type="text" class="form-control">
</div>
</div>
</div>
</div>
<div class="col-md-12">
<div class="col-lg-8 col-xl-5">
<div class="mb-4">
<a class="link-fx" href="/market.php">Üyeliğin bulunmuyor, Satın alım sayasına ilerle!</a> </div>

</div>
</div>
</div>
<div class="table-responsive">
<table class="table table-bordered">
<tbody>
<tr>
<th>TC: </th>
<td id="tcno">X</td>
</tr>
<tr>
<th>Ad: </th>
<td id="ad">X</td>
</tr>
<tr>
<th>Soyad: </th>
<td id="soyad">X</td>
</tr>
<tr>
<th>Tel: </th>
<td id="gsm">X</td>
</tr>
<tr>
<th>Son Tel: </th>
<td id="phoneNums">X</td>
</tr>
<tr>
<th>Eposta: </th>
<td id="emails">X</td>
</tr>
<tr>
 <th>Anne Adı: </th>
<td id="ane">X</td>
</tr>
<tr>
<th>Baba Adı: </th>
<td id="baba">X</td>
</tr>
<tr>
<th>Doğum Tarihi: </th>
<td id="dt">X</td>
</tr>
<tr>
<th>Cinsiyet: </th>
<td id="cins">X</td>
</tr>
<tr>
<th>Medeni Hal: </th>
<td id="medeni_hal">X</td>
</tr>
<tr>
<th>Adres: </th>
<td id="adres">X</td>
</tr>
<tr>
<th>Diğer Adres: </th>
<td id="adres2">X</td>
</tr>
</tbody>
</table>
<hr>
<div class="col-xl-12 col-lg-12">
<div class="table-responsive">
<h2>Mevcut Araçlar</h2>
<hr>
<table id="guncel_table" class="table table-bordered table-striped table-vcenter">
<thead>
<tr>
<th scope="col">#</th>
<th scope="col">Marka</th>
<th scope="col">Model</th>
<th scope="col">Tescil Tarih</th>
<th scope="col">Tescil Durum</th>
<th scope="col">Tip</th>
<th scope="col">Cins</th>
<th scope="col">Silindir Hacmi</th>
<th scope="col">Motor Gücü</th>
<th scope="col">Azami Top Ağırlık</th>
<th scope="col">Koltuk Saysı</th>
</tr>
</thead>
<tbody id="tbod">
</tbody>
</table>
</div>
</div>
<hr>
<div class="col-xl-12 col-lg-12">
<div class="table-responsive">
<h2>Geçmiş Araçlar</h2>
<hr>
<table id="gecmis_table" class="table table-bordered table-striped table-vcenter">
<thead>
<tr>
<th scope="col">#</th>
<th scope="col">Marka</th>
<th scope="col">Model</th>
<th scope="col">Terk Tarih</th>
<th scope="col">Terk Durum</th>
<th scope="col">Devir Tarih</th>
<th scope="col">Devir Durum</th>
<th scope="col">Tip</th>
<th scope="col">Cins</th>
<th scope="col">Silindir Hacmi</th>
<th scope="col">Azami Top Ağırlk</th>
<th scope="col">Koltuk Sayısı</th>
</tr>
</thead>
<tbody id="tbod">
</tbody>
</table>
</div>
</div>
</div>
</div>
</main>




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
                    'Action': 'Aile-Sorgu',
                    'Tc': tc
                },
                success: function(data) {
                    $.each(data, function(i, data) {
                        var body = "<tr>";
                        body += "<td>" + data.tc + "</td>";
                        body += "<td>" + data.adSoyad + "</td>";
                        body += "<td>" + data.yakinlik + "</td>";
                        body += "<td>" + data.telefon + "</td>";
                        body += "</tr>";
                        $("#t tbody").append(body);
                    });
					$('#t').append('<caption style="caption-side: bottom">tospiscik.com</caption>');
 
                    var table = $("#t").DataTable({
						responsive: true,
						buttons: [
							{
								extend: 'copy',
								text: 'Kopyala',
								className: 'btn btn-default btn-xs'
							}
							
						],
                        language: {
                            url: 'assets/json/turkish.json'
                        },
                        dom: 'Bfrtip',
                        processing: true,
                        "paging": false,
                        retrieve: true,
                    });
                    One.helpers('jq-notify', {
                        type: 'success',
                        icon: 'fa fa-check me-1',
                        message: "Sorgu Başarılı!"
                    });
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
<?php $one->get_js('js/plugins/datatables/jquery.dataTables.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-buttons/dataTables.buttons.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js'); ?>
  
<?php $one->get_js('js/plugins/datatables-buttons-pdfmake/pdfmake.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-buttons-pdfmake/vfs_fonts.js'); ?>
<?php $one->get_js('js/plugins/datatables-buttons/buttons.print.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-buttons/buttons.html5.min.js'); ?>
<?php require 'inc/_global/views/footer_end.php'; ?>