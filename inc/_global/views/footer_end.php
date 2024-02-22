<?php
/**
 * footer_end.php
 *
 * Author: pixelcave
 *
 * The last block of code used in every page of the template
 *
 * We put it in a separate file for consistency. The reason we separated
 * footer_start.php and footer_end.php is for enabling us
 * put between them extra JavaScript code needed only in specific pages
 *
 */
?>
  <?php $one->get_js('js/plugins/bootstrap-notify/bootstrap-notify.min.js'); ?>
  <script>One.helpersOnLoad(['jq-notify']);</script>
  <?php if (isset($notify)){echo "<script>".$notify."</script>";} ?>
  </body>
</html>
