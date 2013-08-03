<div class="row">
	<div class="btn-group">
		<?php echo $this->Html->link($this->Html->image('icons/csv.png').'&nbsp;'.__('Export Items'), array('controller' => 'container_items', 'action' => 'export'), array('class' => 'btn btn-primary', 'title' => __('Export the list of all items to CSV'), 'escape' => false)); ?>
	</div>
	<div class="affix-hidden pull-right">
	<?php
		echo $this->Form->create(null, array('class' => 'form-inline pull-right', 'id' => 'container-item-filter'));
	?>
	<?php echo $this->Form->input('order', array('options' => array('body' => 'Item Text', 'modified' => 'Modified Date'), 'label' => false, 'empty' => '(Order By)', 'div' => false, 'class' => 'form-control', 'style' => 'width: 100px')); ?>
	<?php echo $this->Form->input('direction', array('options' => array('asc' => __('Ascending'), 'desc' => __('Descending')), 'label' => false, 'empty' => __('(Direction)'), 'div' => false, 'class' => 'form-control', 'style' => 'width: 100px')); ?>
	<button id="sort-button" type="submit" class="btn btn-default"><i class="icon-sort-by-attributes"></i> <?php echo __('Sort') ?></button>
	<?php echo $this->Form->end(); ?>
	</div>
</div>

