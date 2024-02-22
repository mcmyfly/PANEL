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
<h2 class="d-print-none">Ad Soyad VIP</h2>
<div class="row">
<div class="col-sm-12 col-md-6">
<div class="col-lg-12 col-xl-12">
<div class="mb-4">
<div class="alert alert-dark alert-dismissible fade show" role="alert">
<strong>Bilgilendirme:</strong> Herhangi bir tabloyu doldurarak sorgulayabilirsiniz.<br>
<strong>Örnek:</strong> Sadece AD yazıp sorgu atabilirsiniz.
</div>
</div>
<div class="mb-4">
<div class="input-group">
<span class="input-group-text">Ad</span>
<input id="ad" type="text" class="form-control">
</div>
</div>
<div class="mb-4">
<div class="input-group">
<span class="input-group-text">Soyad</span>
<input id="soyad" type="text" class="form-control">
</div>
</div>
<div class="mb-4">
<div class="input-group">
<span class="input-group-text">Doğum Tarihi</span>
<input data-provide="datepicker" type="text" class="js-datepicker form-control js-datepicker-enabled" id="dogum_tarihi" name="datepicker" data-year-start="-18" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-aa-gg">
</div>
</div>
<div class="mb-4">
<div class="input-group">
<span class="input-group-text">Anne Adı</span>
<input id="anne_ad" type="text" class="form-control">
</div>
</div>
<div class="mb-4">
<div class="input-group">
<span class="input-group-text">Baba Adı</span>
<input id="baba_ad" type="text" class="form-control">
</div>
</div>
<div class="mb-4">
<div class="form-check form-switch">
<input class="form-check-input" type="checkbox" value="" id="olu_diri" name="example-switch-default2">
<label class="form-check-label" for="example-switch-default2">Sadece ölüleri sorgula</label>
</div>
</div>
</div>
</div>
<div class="col-sm-12  col-md-6">
<div class="col-lg-12 col-xl-12">
<div class="mb-4">
<div class="alert alert-dark alert-dismissible fade show" role="alert">
<strong>Uyarı:</strong> Tabloda veri çıkmıyorsa seçilen il ilçe uyuşmuyor olabilir.<br>
<strong>Not:</strong> Sonuç doğruluğunu artırmak için daha fazla veri girişi yapmaya çalışn.
</div>
</div>
<div class="mb-4">
<div class="input-group">
<span class="input-group-text">Adres İl</span>
<input id="Adres_İl" type="text" class="form-control">
</div>
</div>
<div class="mb-4">
<div class="input-group">
<span class="input-group-text">Adres İlce</span>
<input id="Adres_İlce" type="text" class="form-control">
</div>
</div>
<div class="mb-4">
<div class="input-group">
<span class="input-group-text">Memleket İl</span>
<input id="Memleket_İl" type="text" class="form-control">
</div>
</div>
<div class="mb-4">
<div class="input-group">
<span class="input-group-text">Memleket İlce</span>
<input id="Memleket_İlce" type="text" class="form-control">
</div>
</div>
<div class="form-group row sifirla">

<div class="col-12 col-md-4 sifirla"> 
   <select name="ctl00$ctl37$g_866b0f8a_3abe_4117_93d8_a540423922f8$ctl00$DropDownListIl" onchange="javascript:setTimeout(&#39;__doPostBack(\&#39;ctl00$ctl37$g_866b0f8a_3abe_4117_93d8_a540423922f8$ctl00$DropDownListIl\&#39;,\&#39;\&#39;)&#39;, 0)" id="ctl00_ctl37_g_866b0f8a_3abe_4117_93d8_a540423922f8_ctl00_DropDownListIl" class="form-control">
           <option selected="selected" value="Cinsiyet Seçiniz">Cinsiyet Seçiniz</option>
           <option value="Erkek">Erkek</option>
           <option value="Kadın">Kadın</option>
           

       </select>
<span id="ctl00_ctl37_g_866b0f8a_3abe_4117_93d8_a540423922f8_ctl00_RequiredFieldValidator1" class="text-danger" style="visibility:hidden">Lütfen İl Seçiniz!</span>

</div>
<div class="form-group row sifirla">

<div class="col-12 col-md-4 sifirla"> 
   <select name="ctl00$ctl37$g_866b0f8a_3abe_4117_93d8_a540423922f8$ctl00$DropDownListIl" onchange="javascript:setTimeout(&#39;__doPostBack(\&#39;ctl00$ctl37$g_866b0f8a_3abe_4117_93d8_a540423922f8$ctl00$DropDownListIl\&#39;,\&#39;\&#39;)&#39;, 0)" id="ctl00_ctl37_g_866b0f8a_3abe_4117_93d8_a540423922f8_ctl00_DropDownListIl" class="form-control">
           <option selected="selected" value="Medeni Hal">Medeni Hal</option>
<option value="Bekâr" data-subtext="Bekâr">Bekâr</option>
<option value="Evli" data-subtext="Evli">Evli</option>
<option value="Boşanmış" data-subtext="Boşanmış">Boanmış</option>
<option value="Dul" data-subtext="Dul">Dul</option>
<option value="Evliliğin Feshi" data-subtext="Evliliğin Feshi">Evliliğin Feshi</option>
<option value="Evliliğin İptali" data-subtext="Evliliğin İptali">Evliliğin İptali</option>
</select>
<span id="ctl00_ctl37_g_866b0f8a_3abe_4117_93d8_a540423922f8_ctl00_RequiredFieldValidator1" class="text-danger" style="visibility:hidden">Lütfen İl Seçiniz!</span>

</div>
</div>
</div>
</div>
<div class="row">
<div class="col">
<div class="mb-4">
<a class="link-fx" href="/market.php">Üyeliğin bulunmuyor, Satın alım sayasına ilerle!</a> 
   </div>
</div>
</div>
</div>
<div class="row gx-12">
<div class="col-xl-12 col-lg-6">
<div class="table-responsive">
<table id="t" class="table table-bordered table-striped table-vcenter">
<thead>
<tr>
<th>TC</th>
<th>AD</th>
<th>SOYAD</th>
<th>DOGUM TARIHI</th>
<th>GSM</th>
<th>BABA ADI</th>
<th>BABA TC</th>
<th>ANNE ADI</th>
<th>ANNE TC</th>
<th>DOGUM YERI</th>
<th>OLUM TARIHI</th>
<th>ADRES IL</th>
<th>ADRES ILCE</th>
<th>MEDENI HAL</th>
<th>MEMLEKET IL</th>
<th>MEMLEKET ILCE</th>
<th>MEMLEKET KOY</th>
<th>CINSIYET</th>
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