<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/user.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
function copyURI(evt) {
    evt.preventDefault();
    navigator.clipboard.writeText(evt.target.getAttribute('href').replace("#", "")).then(() => {
                One.helpers('jq-notify', {
                    type: 'success',
                    icon: 'fa fa-check me-1',
                    message: "Link Başarıyla Panoya Kopyalandı!"
                });
    }, () => {
		One.helpers('jq-notify', {type: 'warning', icon: 'fa-solid fa-triangle-exclamation me-1', message: 'Panoya Kopyalama Başarısız!'});
    });
}
</script>
<style>
#shadowBox {
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.2);
    /* Black w/opacity/see-through */
    border: 3px solid;
}

.rainbow {
    text-align: center;
    text-decoration: underline;
    font-size: 32px;
    font-family: monospace;
    letter-spacing: 3px;
}
.rainbow_text_animated {
    background: linear-gradient(to right, #6666ff, #0099ff , #00ff00, #ff3399, #6666ff);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    animation: rainbow_animation 6s ease-in-out infinite;
    background-size: 400% 100%;
}

@keyframes rainbow_animation {
    0%,100% {
        background-position: 0 0;
    }

    50% {
        background-position: 100% 0;
    }
}
</style>
<!-- Hero -->
<div class="content">
  <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
    <div class="flex-grow-1 mb-1 mb-md-0">
      <h1 class="h3 fw-bold mb-2">
      RelaX Checker
      </h1>
      <h2 class="h6 fw-medium fw-medium text-muted mb-0">	
        <?= $welcome_text?> <a class="fw-semibold" href="#"><?= $username ?></a> <?= $welcome_text_1 ?>
      </h2>
    </div>
  </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
  <!-- Overview -->
  <div class="row items-push">
  <div class="col-sm-12 col-xxl-12">
      <!-- Pending Orders -->
      <div data-bs-toggle="tooltip" data-bs-placement="left" title="Premiumunuzun bitmesine kalan süre." class="block block-rounded d-flex flex-column h-100 mb-0">
        <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
          <dl class="mb-0">
            <dt class="fs-3 fw-bold"><?= $premium_days ?></dt>
            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0"><?= $premium_text ?></dd>
          </dl>
          <div class="item item-rounded-lg bg-body-light">
            <i class="far fa-gem fs-3 text-primary"></i>
          </div>
        </div>
      </div>
      <!-- END Pending Orders -->
    </div>
    <div class="col-sm-4 col-xxl-4">
      <!-- Pending Orders -->
      <div data-bs-toggle="tooltip" data-bs-placement="left" title="Referans ile kayıt olmuş, premium satın almış ve yönetici onayından geçen toplam premium kullanıcı sayısı." class="block block-rounded d-flex flex-column h-100 mb-0">
        <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
          <dl class="mb-0">
            <dt class="fs-3 fw-bold"><?= $premium_count_text ?></dt>
            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Premium Kullanıcılar</dd>
          </dl>
          <div class="item item-rounded-lg bg-body-light">
            <i class="far fa-gem fs-3 text-primary"></i>
          </div>
        </div>
      </div>
      <!-- END Pending Orders -->
    </div>
    <div class="col-sm-4 col-xxl-4">
      <!-- Pending Orders -->
      <div data-bs-toggle="tooltip" data-bs-placement="left" title="Referans numarası ile sisteme kayıt olmuş ama yönetici onayı bekleyen kullanıcı sayısı." class="block block-rounded d-flex flex-column h-100 mb-0">
        <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
          <dl class="mb-0">
            <dt class="fs-3 fw-bold" ><?= $waiting_verify ?></dt>
            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Onay Bekleyenler</dd>
          </dl>
          <div class="item item-rounded-lg bg-body-light">
            <i class="fa fa-clock fs-3 text-primary"></i>
          </div>
        </div>
      </div>
      <!-- END Pending Orders -->
    </div>
    <div class="col-sm-4 col-xxl-4">
      <!-- New Customers -->
      <div data-bs-toggle="tooltip" data-bs-placement="left" title="Sisteme kayıt olmuş onaylı onaysız toplam kullanıcı sayısı." class="block block-rounded d-flex flex-column h-100 mb-0">
        <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
          <dl class="mb-0">
            <dt class="fs-3 fw-bold"><?= $all_count_text ?></dt>
            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Kayıtlı Kullanıcı</dd>
          </dl>
          <div class="item item-rounded-lg bg-body-light">
            <i class="far fa-user-circle fs-3 text-primary"></i>
          </div>
        </div>
      </div>
      <!-- END New Customers -->
    </div>
      
    <div class="col-sm-6 col-xxl-6">
      <!-- Messages -->
      <div data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="left" title="
		  • Elite Vip I: Seri No<br>
		  • Elite Vip II: Ad Soyad<br>
		  • Super Vip V: Hepsi<br>
		  • Vip I: Seri No (Hak)<br>
		  • Vip II: Ad Soyad (Hak)<br>
	  " class="block block-rounded d-flex flex-column h-100 mb-0">
        <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
          <dl class="mb-0">
            <?= $get_vip ?>
          </dl>
          <div class="item item-rounded-lg bg-body-light">
            <i class="fab fa-superpowers fs-3 text-primary"></i>
          </div>
        </div>
      </div>
      <!-- END Messages -->
    </div>
    <div class="col-sm-6 col-xxl-6">
      <!-- Conversion Rate -->
      <div data-bs-toggle="tooltip" data-bs-placement="left" title="Kopyalamak için tıklayın, Sadece kesinlikle ödeme yapacak referans olduğunuz kullanıcıları davet edin. Kullanıcının yaptığı herhangi bir olumsuzlukta sizde etkilenirsiniz." class="block block-rounded d-flex flex-column h-100 mb-0">
        <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
          <dl class="mb-0">
            <dt class="fs-3 fw-bold"><a onclick="copyURI(event)" href="#/kayit.jsp?ref=<?= $ref_c ?>"><?= $ref_c ?></a></dt>
            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Referans Kodu</dd>
          </dl>
          <div class="item item-rounded-lg bg-body-light">
            <i class="fas fa-link fs-3 text-primary"></i>
          </div>
        </div>
      </div>
      <!-- END Conversion Rate-->
  <!-- END Overview -->
    </div>
  </div>
  <!-- END Recent Orders -->
   <div class="col-sm-16 col-xxl-16">
      <!-- Messages -->
      <div data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="left" title="
		  KURALLAR
	  " class="block block-rounded d-flex flex-column h-100 mb-0">
        <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
          <dl class="mb-0">
            <center>DUYURU</center>
          <td></td><br> 
          <td>-	Başkası'nın Hesabını Kullanmak Yasaktır!</td><br> 
          <td>-	Hesap Satışları Kesinlikle Yasaktır!</td><br> 
          <td>-	Tek Cihazdan Giriş Yapınız! Hesabınız Ban Yerse Sorumluluk Size Aittir!</td><br> 
          <td>-	Multi Hesap Kullananlar Kalıcı Şekilde Yasaklanır!</td> <br>    
 <a class="fw-semibold" href="https://discord.gg/ef6Dy2SRaz" target="_blank">Discord'a Katıl</a>
    
        </div>
      </div>
    
  <!-- END Overview -->
    </div>
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<script defer>
	$(document).ready(function() {
		$(function() {
            $(this).bind("contextmenu", function(e) {
                e.preventDefault();
            });
        }); 
		$(document).bind('selectstart dragstart', function(e) {
		  e.preventDefault();
		  return false;
		});
		$(document).ready(function(){
		  $(document).bind("cut copy paste",function(e) {
			  e.preventDefault();
		  });
		});
		$('img').on('dragstart', function(event) { event.preventDefault(); });
		$('img').bind('contextmenu', function(e) { return false; }); 
		$('#logo-container').on('contextmenu', 'img', function(e){ return false; });
	}); 
</script>
<!-- Page JS Code -->


<?php require 'inc/_global/views/footer_end.php'; ?>
