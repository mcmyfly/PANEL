<?php ?>
<script>localStorage.setItem('oneuiDarkMode', true);</script>
<div data-action="dark_mode_toggle" id="page-container"<?php $one->page_classes(); ?>>
<?php if(isset($one->page_loader) && $one->page_loader) { ?>
<div id="page-loader" class="show"></div>
<?php } ?>
<?php if(isset($one->inc_sidebar) && $one->inc_sidebar) { include($one->inc_sidebar); } ?>
<?php if(isset($one->inc_header) && $one->inc_header) { include($one->inc_header); } ?>
<main id="main-container">