<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/user.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>
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
    font-size: 24px;
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
<!-- Page Content -->
<div class="content">
  <div class="row push">
    <div class="col-xl-12 order-xl-12">
      <!-- Products -->
      <div class="row items-push">
		<div class="col-md-3 col-xl-3">
          <div class="block block-rounded h-80 mb-0">
            <div class="block-content p-1">
              <div class="options-container">
    
                <div class="options-overlay bg-black-75">
                  <div class="options-overlay-content">
                  
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="block-content">
              <div class="mb-1">
                <div class="fw-semibold float-end ms-1 rainbow rainbow_text_animated">200₺</div>
                <a class="h6" href="">Sınırsız Normal</a>
              </div>
              <p class="fs-sm text-muted">Sadece Normal Üyelik.</p>
            </div>
          </div>
        </div>
        <div class="row items-push">
		<div class="col-md-6 col-xl-6">
          <div class="block block-rounded h-80 mb-0">
            <div class="block-content p-1">
              <div class="options-container">
                <img class="img-fluid options-item" src="<?php echo $one->assets_folder; ?>/media/photos/card2.png" alt="Product-1">
                <div class="options-overlay bg-black-75">
                  <div class="options-overlay-content">
                    <a class="btn btn-sm btn-alt-secondary" href="">
                      Satın Almak İçin Tıkla
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="block-content">
              <div class="mb-1">
                <div class="fw-semibold float-end ms-1 rainbow rainbow_text_animated">150₺</div>
                <a class="h6" href="">Premium</a>
              </div>
              <p class="fs-sm text-muted">Sadece Premium.</p>
            </div>
          </div>
        </div>
		<div class="col-md-6 col-xl-6">
          <div class="block block-rounded h-80 mb-0">
            <div class="block-content p-1">
              <div class="options-container">
                <img class="img-fluid options-item" src="<?php echo $one->assets_folder; ?>/media/photos/vipmisbakbakbak.png" alt="Product-1">
                <div class="options-overlay bg-black-75">
                  <div class="options-overlay-content">
                    <a class="btn btn-sm btn-alt-secondary" href="">
                      Satın Almak İçin Tıkla
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="block-content">
              <div class="mb-1">
                <div class="fw-semibold float-end ms-1 rainbow rainbow_text_animated">250₺</div>
                <a class="h6" href="">Vip</a>
              </div>
              <p class="fs-sm text-muted">En yüksek üyeliktir (Premium'da Kullanabilirsiniz).</p>
            </div>
          </div>
        </div>
				
		<div class="col-md-12 col-xl-12">
          <div class="block block-rounded h-80 mb-0">
		  <center>
			<img id="logo-container" src="<?php echo $one->assets_folder; ?>/media/photos/arkasiolanbanner44.png" alt="Login Logo" style="width: 80%;">
		  </center>
          </div>
        </div>
                        
	  </div>
      <!-- END Products -->
    </div>
  </div>
</div>
<!-- END Page Content -->
<?php $one->get_js('js/lib/jquery.min.js'); ?>
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
<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
