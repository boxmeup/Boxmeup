<h2><?php echo __('Edit Container'); ?></h2>
<br/>
<?php 
	echo $this->Form->create('Container', array('url' => array('action' => 'edit'), 'class' => 'form-horizontal')); 
	echo $this->Form->hidden('Container.uuid');
?>
<div class="form-group">
	<label for="ContainerName" class="col-lg-2"><?php echo __('Name') ?></label>
	<div class="col-lg-10">
		<?php echo $this->Form->input('name', array('label' => false, 'class' => 'form-control')); ?>
	</div>
</div>
<div class="form-group">
	<label for="ContainerLocation" class="col-lg-2"><?php echo __('Location') ?></label>
	<div class="col-lg-10">
		<?php 
			echo $this->Form->input('location_id', array('label' => false, 'options' => $location_list, 'empty' => '-- Unassigned --', 'class' => 'form-control'));
		?>
		<br>
		<button type="submit" class="btn btn-primary"><?php echo __('Update Container') ?></button>
	</div>
</div>
<?php echo $this->Form->end();
