<div style="text-align: center">
	<h2><?php echo Sanitize::html($container['Container']['name'], array('remove' => true)); ?></h2>
	<?php echo $this->QR->image($Fullwebroot.'/containers/view/'.$container['Container']['slug']); ?>
</div>

