<?php
	echo $this->Html->script('views/locations/add', array('inline' => false));
?>
<h2><?php echo __('Add Location'); ?></h2>
<div class="left-form">
<?php
	echo $this->Form->create('Location', array('url' => array('controller' => 'locations', 'action' => 'add')));
	echo $this->Form->input('name', array('label' => __('Name')));
	echo '<br/>';
	echo $this->Form->submit(__('Attach a Map'), array('class' => 'btn primary attach-map btn-inline'));
	echo $this->Form->submit(__('Save'), array('class' => 'btn success btn-inline no-map-save'));
?>
	<div class="location-details" style="display: none; clear: both;">
	<?php
		echo $this->Form->input('address', array('label' => __('Address')));
		echo '<br/>';
		echo $this->Form->submit(__('Preview'), array('class' => 'btn primary preview-button'));
		echo $this->Form->submit(__('Save'), array('class' => 'btn success map-save btn-inline')).'&nbsp;&nbsp;';
	?>
	</div>
<?php
	echo $this->Form->end();
?>
</div>
<div class="preview">
	<?php
		$address = !empty($this->request->data['Location']) ? implode(',', $this->request->data['Location']) : '';
	?>
	<img class="preview-map" src="http://maps.googleapis.com/maps/api/staticmap?size=350x350&sensor=false&maptype=roadmap&markers=size:small|color:red|<?php echo $address ?>" />
</div>
<div style="clear: both"></div>