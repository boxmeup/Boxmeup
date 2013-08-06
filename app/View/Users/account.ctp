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
<?php if (Configure::read('Feature.api')) : ?>
	<br/><hr/><br/>
	<h3><?php echo __('API Access'); ?></h3><br/>
	<p><b><?php echo __('Status'); ?></b>: <?php echo !empty($api_key) ? ('<span style="color: green">' . __('Enabled') . '</span>') : ('<span style="color:red">' . __('Disabled') . '</span>'); ?></p>
	<?php
		if(!empty($api_key)) {
			echo '<p><b>' . __('Api Key') . '</b>: ' . $api_key . '</p>';
			echo '<p><b>' . __('Secret Key') . '*</b>: ' . $secret_key . '</p>';
		}
	?>
	<br/>
	<a href="https://github.com/boxmeup/Boxmeup/wiki/API-Documentation" class="btn btn-info" target="_NEW"><?php echo __('Developer API Documentation'); ?></a>
	<br/>
	<br/>
	<small>
	* <?php echo __('For security purposes of your account, do not share your secret key with anyone.'); ?>
	</small>
<?php endif; ?>
