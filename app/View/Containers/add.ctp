<h2><?php echo __('Add New Container'); ?></h2>
<?php
	echo $this->Form->create('Container', array('url' => array('controller' => 'containers', 'action' => 'add'), 'class' => 'form-horizontal'));
?>
<div class="form-group">
	<label for="ContainerName" class="col-lg-2"><?php echo __('Name'); ?></label>
	<div class="col-lg-10">
		<?php echo $this->Form->input('name', array('label' => false, 'class' => 'focus form-control')); ?>
		<br>
		<button type="submit" class="btn btn-success"><?php echo __('Add') ?></button>
	</div>
</div>
<?php echo $this->Form->end();
