<?php if(!$message_dismissed) { ?>
<div class="message">
	<?php echo Configure::read('Message.message'); ?>
	<br/><br/>
	<?php echo $this->Html->link('Dismiss Message', '#', array('class' => 'dismiss')); ?>
</div>
<?php } ?>