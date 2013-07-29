<div class="row">
	<div class="col-lg-5">
		<div class="btn-group">
			<?php echo $this->Html->link(__('Add Container'), array('controller' => 'containers', 'action' => 'add'), array('class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#layout-modal')); ?>
			<?php echo $this->Html->link($this->Html->image('icons/print.png').'&nbsp; ' . __('Bulk Print'), array('controller' => 'containers', 'action' => 'bulk_print'), array('class' => 'btn btn-info', 'data-toggle' => 'modal', 'data-target' => '#layout-modal', 'escape' => false, 'title' => 'Print multiple labels at once'));
			?>
		</div>
	</div>
	<div class="col-lg-7">
		<?php
			echo $this->Form->create(null, array('class' => 'form-inline', 'id' => 'container-filter'));
			echo $this->Form->select('Location.uuid', $location_list, array('empty' => __('All Locations'), 'class' => 'form-control', 'style' => 'width: 130px'));
		?>
		<?php echo $this->Form->input('order', array('options' => array('Container.name' => 'Container Name', 'Container.modified' => 'Modified Date'), 'label' => false, 'empty' => '(Order By)', 'div' => false, 'class' => 'form-control', 'style' => 'width: 130px')); ?>
		<?php echo $this->Form->input('direction', array('options' => array('asc' => __('Ascending'), 'desc' => __('Descending')), 'label' => false, 'empty' => __('(Direction)'), 'div' => false, 'class' => 'form-control', 'style' => 'width: 130px')); ?>
		<button id="sort-button" type="submit" class="btn btn-default"><?php echo __('Sort') ?></button>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
<div class="spacer"></div>
