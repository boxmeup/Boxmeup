<h2><?php echo __('My Account'); ?></h2>
<br>
<?php
	echo $this->Form->create('User', array('url' => array('action' => 'account'), 'class' => 'form-horizontal'));
?>
<div class="form-group">
	<label for="UserEmail" class="col-lg-3"><?php echo __('Update Email') ?></label>
	<div class="col-lg-9">
		<?php echo $this->Form->input('email', array('label' => false, 'class' => 'form-control')); ?>
	</div>
</div>
<div class="form-group">
	<label for="UserPassword" class="col-lg-3"><?php echo __('Update Password') ?></label>
	<div class="col-lg-9">
		<?php echo $this->Form->input('password', array('placeholder' => 'Leave blank if you do not wish to change.', 'label' => false, 'class' => 'form-control', 'required' => false)); ?>
		<br>
		<button type="submit" class="btn btn-primary"><?php echo __('Update Account Settings') ?></button>
	</div>
</div>
<?php echo $this->Form->end(); ?>
