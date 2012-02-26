<?php if(!$message_dismissed) { ?>
<div class="message">
	<?php echo Configure::read('Message.message'); ?>
	<br/><br/>
	<?php echo $this->Html->link(__('Dismiss Message', true), '#', array('class' => 'btn small dismiss', 'style' => 'float: right')); ?>
	<div style="clear: both"></div>
</div>
<?php } ?>