<h2><?php echo __('Edit Item'); ?></h2><br/>
<?php
	echo $this->Form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'edit'), 'class' => 'form-horizontal'));
	echo $this->Form->input('ContainerItem.uuid', array('type' => 'hidden'));
	echo $this->Form->input('Container.slug', array('type' => 'hidden'));
?>
<div class="form-group">
	<label for="ContainerItemBody" class="col-lg-2"><?php echo __('Item Content') ?></label>
	<div class="col-lg-10">
		<?php echo $this->Form->input('body', array('label' => false, 'class' => 'form-control focus', 'div' => false)); ?>
	</div>
</div>
<div class="form-group">
	<label for="ContainerItemQuantity" class="col-lg-2"><?php echo __('Quantity') ?></label>
	<div class="col-lg-10">
		<?php echo $this->Form->input('quantity', array('label' => false, 'type' => 'text', 'maxlength' => 5, 'class' => 'form-control', 'div' => false)); ?>
	</div>
</div>
<div class="form-group">
	<label for="ContainerUuid" class="col-lg-2"><?php echo __('Container') ?></label>
	<div class="col-lg-10">
		<?php echo $this->Form->input('Container.uuid', array('options' => $containers, 'label' => false, 'class' => 'form-control', 'div' => false)); ?>
		<br>
		<button type="submit" class="btn btn-primary"><?php echo __('Save Item') ?></button>
	</div>
</div>
<?php
	echo $this->Form->end();
