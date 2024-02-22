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

<div class="modal fade bd-example-modal-xl show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Sahipler</h5>
</div>
<div class="modal-body">
<table id="html5-extension2" class="table table-hover non-hover" style="width:100%">
<thead>
<tr>
<th colspan="4">Sahip</th>
<th>Kişi Tip</th>
<th>Pay</th>
<th>Payda</th>
<th>Hisse Tip</th>
<th>Edinme Sebebi</th>
<th>Edinme Tarihi</th>
</tr>
</thead>
<tbody id="results2">
</tbody>
</table>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Kapat</button>
</div>
</div>
</div>
</div>
<div class="content">
<h2 class="d-print-none">Parsel Sorgu</h2>
<div class="row">
<div class="col-md-12">
<div class="col-lg-8 col-xl-5">
<div class="alert alert-dark alert-dismissible fade show" role="alert">
Parsel sorgularınızda. Ada Yada Parsel Olmadığı Sorgulamalarınızda Olmayan Parsel ise (0) Giriniz. Ada No girip sorgu yapabilirsiniz. </a>
</div>
</div>
<div class="col-lg-8 col-xl-5">
<div class="mb-4">
<div class="input-group">
<select class="form-control basic" id="city">
<option disabled="" selected="" value="0">İl Seçiniz</option>
<option value="23">Adana</option>
<option value="24">Adiyaman</option>
<option value="25">Afyonkarahisar</option>
<option value="26">Ağri</option>
<option value="90">Aksaray</option>
<option value="27">Amasya</option>
<option value="28">Ankara</option>
<option value="29">Antalya</option>
<option value="97">Ardahan</option>
<option value="30">Artvin</option>
<option value="31">Aydin</option>
<option value="32">Balikesir</option>
<option value="96">Bartin</option>
<option value="94">Batman</option>
<option value="91">Bayburt</option>
<option value="33">Bilecik</option>
<option value="34">Bingöl</option>
<option value="35">Bitlis</option>
<option value="36">Bolu</option>
<option value="37">Burdur</option>
<option value="38">Bursa</option>
<option value="39">Çanakkale</option>
<option value="40">Çankiri</option>
<option value="41">Çorum</option>
<option value="42">Denizli</option>
<option value="43">Diyarbakir</option>
<option value="103">Düzce</option>
<option value="44">Edirne</option>
<option value="45">Elaziğ</option>
<option value="46">Erzincan</option>
<option value="47">Erzurum</option>
<option value="48">Eskişehir</option>
<option value="49">Gaziantep</option>
<option value="50">Giresun</option>
<option value="51">Gümüşhane</option>
<option value="52">Hakkari</option>
<option value="53">Hatay</option>
<option value="98">Iğdir</option>
<option value="54">Isparta</option>
<option value="56">Istanbul</option>
<option value="57">Izmir</option>
<option value="68">Kahramanmaraş</option>
<option value="100">Karabük</option>
<option value="92">Karaman</option>
<option value="58">Kars</option>
<option value="59">Kastamonu</option>
<option value="60">Kayseri</option>
<option value="101">Kilis</option>
<option value="93">Kirikkale</option>
<option value="61">Kirklareli</option>
<option value="62">Kirşehir</option>
<option value="63">Kocaeli</option>
<option value="64">Konya</option>
<option value="65">Kütahya</option>
<option value="66">Malatya</option>
<option value="67">Manisa</option>
<option value="69">Mardin</option>
<option value="55">Mersin</option>
<option value="70">Muğla</option>
<option value="71">Muş</option>
<option value="72">Nevşehir</option>
<option value="73">Niğde</option>
<option value="74">Ordu</option>
<option value="102">Osmaniye</option>
 <option value="75">Rize</option>
<option value="76">Sakarya</option>
<option value="77">Samsun</option>
<option value="85">Şanliurfa</option>
<option value="78">Siirt</option>
<option value="79">Sinop</option>
<option value="95">Şirnak</option>
<option value="80">Sivas</option>
<option value="81">Tekirdağ</option>
<option value="82">Tokat</option>
<option value="83">Trabzon</option>
<option value="84">Tunceli</option>
<option value="86">Uşak</option>
<option value="87">Van</option>
<option value="99">Yalova</option>
<option value="88">Yozgat</option>
<option value="89">Zonguldak</option>
</select>
</div>
<div class="input-group mt-2">
<select id="district" class="form-control basic">
<option value="0" disabled="" selected="">İlçe Seçin</option>
</select>
</div>
<div class="input-group mt-2">
<select id="mahalle" class="form-control basic">
<option value="0" disabled="" selected="">Mahalle Seçin</option>
</select>
</div>
<div class="input-group mt-2">
<input type="text" class="form-control basic" id="ada" placeholder="Ada">
</div>
<div class="input-group mt-2">
<input type="text" class="form-control basic" id="parsel" placeholder="Parsel">
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
<div class="row gx-12">
<div class="table-responsive">
<table id="t" class="table table-hover non-hover" style="width:100%">
<thead>
<tr>
<th>Ada</th>
<th>Parsel</th>
<th>Cilt No</th>
<th>İl</th>
<th>İlçe</th>
<th>Mahalle</th>
<th>Nitelik</th>
<th>Taşınmaz Tip</th>
<th>Yüz Ölçüm</th>
<th>Bağımsız No</th>
<th>Sahip</th>
</tr>
</thead>
<tbody id="results">
</tbody>
</table>
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