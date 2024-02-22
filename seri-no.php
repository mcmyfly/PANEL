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
<div class="content" bis_skin_checked="1">
<h2 class="d-print-none">Seri No Sorgu</h2>
<div class="row" bis_skin_checked="1">
<div class="col-md-12" bis_skin_checked="1">
<div class="col-lg-8 col-xl-5" bis_skin_checked="1">
<div class="mb-4" bis_skin_checked="1">
<span style="font-weight: bold">18 Yaş ve üstü kişilerin serino bilgileri çıkmaktadır.</span>
</div>
<div class="mb-4" bis_skin_checked="1">
<div class="input-group" bis_skin_checked="1">
<span class="input-group-text">TC</span>
<input id="tc" type="text" class="form-control" maxlength="11">
</div>
</div>
</div>
</div>
<div class="col-md-12" bis_skin_checked="1">
<div class="col-lg-8 col-xl-5" bis_skin_checked="1">
<div class="mb-4" bis_skin_checked="1">
<button class="btn btn-secondary" onclick="if (!window.__cfRLUnblockHandlers) return false; sorgula()" type="button">Sorgula</button>
</div>
</div>
</div>
<div class="col-md-12" bis_skin_checked="1">
<div class="col-lg-8 col-xl-5" bis_skin_checked="1">
<div class="mb-4" bis_skin_checked="1">
<button id="copyall" class="btn btn-secondary" style="display: none;"></button>
</div>
</div>
</div>
</div>
<div class="row gx-12" bis_skin_checked="1">
<div class="col-xl-6 col-lg-6" bis_skin_checked="1">
<div class="table-responsive" bis_skin_checked="1">
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
<th>Seri No: </th>
<td id="seri">X</td>
</tr>
<tr>
<th>Doğum Tarihi: </th>
<td id="dt">X</td>
</tr>
<tr>
<th>Anne Adı: </th>
<td id="anne">X</td>
</tr>
<tr>
<th>Baba Adı: </th>
<td id="baba">X</td>
</tr>
<tr>
<th>Doğum Yeri: </th>
<td id="dy">X</td>
</tr>
<tr>
<th>Medeni Durumu: </th>
<td id="md">X</td>
</tr>
<tr>
<th>Cilt No: </th>
<td id="cn">X</td>
</tr>
<tr>
<th>Aile Sıra No: </th>
<td id="as">X</td>
</tr>
<tr>
<th>Birey Sıra No: </th>
<td id="bs">X</td>
</tr>
<tr>
<th>Adres: </th>
<td id="adres">X</td>
 </tr>
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
                    'Action': 'Seri-No',
                    'Tc': tc
                },
                success: function(response) {
                    var data = response;
                    One.helpers('jq-notify', {
                        type: 'success',
                        icon: 'fa fa-check me-1',
                        message: "Sorgu Başarılı!"
                    });
                    document.getElementById("tcno").innerHTML = tc;
                    document.getElementById("ad").innerHTML = data.ad;
                    document.getElementById("soyad").innerHTML = data.soyad;
                    document.getElementById("dt").innerHTML = data.dogum_tarihi.replace("T00:00:00", "");
                    document.getElementById("dy").innerHTML = data.dogum_yeri;
                    document.getElementById("anne").innerHTML = data.ana_adi;
                    document.getElementById("baba").innerHTML = data.baba_adi;
                    document.getElementById("seri").innerHTML = data.seri_no;
                    document.getElementById("md").innerHTML = data.medeni_durumu;
                    document.getElementById("cn").innerHTML = data.cilt_no;
                    document.getElementById("as").innerHTML = data.aile_sira_no;
                    document.getElementById("bs").innerHTML = data.birey_sira_no;
                    document.getElementById("adres").innerHTML = data.adres;
                    document.getElementById("tcnop").innerHTML = tc;
                    document.getElementById("adp").innerHTML = data.ad;
                    document.getElementById("soyadp").innerHTML = data.soyad;
                    document.getElementById("serip").innerHTML = data.seri_no;
                    document.getElementById("dtp").innerHTML = data.dogum_tarihi.replace("T00:00:00", "");
                    document.getElementById("ana").innerHTML = data.ana_adi;
                    document.getElementById("babap").innerHTML = data.baba_adi;
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
                    } else if (status == 402) {
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