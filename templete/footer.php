<?php

$file_conf_obj = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/config.json'));

?>
<div id="footer-bar" class="text-center">
	<p class="mt-5 mb-3 text-muted">
  &copy; <?php echo date('Y'),'&nbsp;-&nbsp;',date('Y')+1; ?>
  by <a class="text-primary"
      target="_blank"
      href="<?php echo $file_conf_obj->MOX_AUTHOR_LINK ?>"
    ><?php echo $file_conf_obj->MOX_AUTHOR ?></a>
  # <?php echo $file_conf_obj->MOX_VERSION ?>
</p>
</div>
