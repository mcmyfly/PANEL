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
    text-align: left;
    text-decoration: none;
    font-size: 22px;
    font-family: 'Poppins', sans-serif;
    letter-spacing: 1px;
}
.rainbow_text_premium {
    background: linear-gradient(to left, #7158e2, #7d5fff, #ff4d4d);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    animation: rainbow_animation 4s ease-in-out infinite;
    background-size: 400% 100%;
}
.rainbow_text_vip {
    background: linear-gradient(to left, #fffa65, #eb3b5a, #ff9f1a);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    animation: rainbow_animation 2s linear infinite;
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
        <div class="col-md-4 col-xl-4">
          <div class="block block-rounded h-80 mb-0">
            <div class="block-content p-1">
              <div class="options-container">
                <img class="img-fluid options-item" src="<?php echo $one->assets_folder; ?>/media/photos/shop-product-1.png" alt="Product-1">
                <div class="options-overlay bg-black-75">
                  <div class="options-overlay-content">
                    <a class="btn btn-sm btn-alt-secondary" href="#">
                      Görüntüle
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="block-content">
              <div class="mb-1">
                <div class="fw-semibold float-end ms-1 rainbow rainbow_text_premium">75₺</div>
                <a class="h6" href="#">Classic - Gold</a>
              </div>
              <p class="fs-sm text-muted">Classic veya Gold bin içerir

</p>
            </div>
          </div>
        </div>
		<div class="col-md-4 col-xl-4">
          <div class="block block-rounded h-80 mb-0">
            <div class="block-content p-1">
              <div class="options-container">
                <img class="img-fluid options-item" src="<?php echo $one->assets_folder; ?>/media/photos/shop-product-1.png" alt="Product-1">
                <div class="options-overlay bg-black-75">
                  <div class="options-overlay-content">
                    <a class="btn btn-sm btn-alt-secondary" href="#">
                      Görüntüle
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="block-content">
              <div class="mb-1">
                <div class="fw-semibold float-end ms-1 rainbow rainbow_text_premium">100₺</div>
                <a class="h6" href="#">Platinum - Business</a>
              </div>
              <p class="fs-sm text-muted">Plat && Buss bin içerir</p>
            </div>
          </div>
        </div>
		<div class="col-md-4 col-xl-4">
          <div class="block block-rounded h-80 mb-0">
            <div class="block-content p-1">
              <div class="options-container">
                <img class="img-fluid options-item" src="<?php echo $one->assets_folder; ?>/media/photos/shop-product-1.png" alt="Product-1">
                <div class="options-overlay bg-black-75">
                  <div class="options-overlay-content">
                    <a class="btn btn-sm btn-alt-secondary" href="#">
                      Görüntüle
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="block-content">
              <div class="mb-1">
                <div class="fw-semibold float-end ms-1 rainbow rainbow_text_premium">125₺</div>
                <a class="h6" href="#">World Black</a>
              </div>
              <p class="fs-sm text-muted">World bin içerir</p>
            </div>
          </div>
        </div>
		<div class="col-md-6 col-xl-6">
          <div class="block block-rounded h-80 mb-0">
            <div class="block-content p-1">
              <div class="options-container">
                <img class="img-fluid options-item" src="<?php echo $one->assets_folder; ?>/media/photos/shop-product-1.png" alt="Product-1">
                <div class="options-overlay bg-black-75">
                  <div class="options-overlay-content">
                    <a class="btn btn-sm btn-alt-secondary" href="#">
                      Görüntüle
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="block-content">
              <div class="mb-1">
                <div class="fw-semibold float-end ms-1 rainbow rainbow_text_premium">275₺</div>
                <a class="h6" href="#">INFINITE</a>
              </div>
              <p class="fs-sm text-muted">Visa'nın en yüksek statüsü.</p>
            </div>
          </div>
        </div>
		<div class="col-md-6 col-xl-6">
          <div class="block block-rounded h-80 mb-0">
            <div class="block-content p-1">
              <div class="options-container">
                <img class="img-fluid options-item" src="<?php echo $one->assets_folder; ?>/media/photos/shop-product-1.png" alt="Product-1">
                <div class="options-overlay bg-black-75">
                  <div class="options-overlay-content">
                    <a class="btn btn-sm btn-alt-secondary" href="#">
                      Görüntüle
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="block-content">
              <div class="mb-1">
                <div class="fw-semibold float-end ms-1 rainbow rainbow_text_premium">80₺</div>
                <a class="h6" href="#">Türkiye Mix</a>
              </div>
              <p class="fs-sm text-muted">Rastele statü seçilir.</p>
            </div>
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
