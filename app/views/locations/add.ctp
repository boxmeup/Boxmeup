<?php
	echo $this->Html->script('views/locations/add', array('inline' => false));
?>
<h2><?php __('Add Location'); ?></h2>
<div class="left-form">
<?php
	echo $form->create('Location', array('url' => array('controller' => 'locations', 'action' => 'add')));
	echo $form->input('name', array('label' => __('Name', true)));
	echo '<br/>';
	echo $form->submit(__('Attach a Map', true), array('class' => 'btn primary attach-map btn-inline'));
	echo $form->submit(__('Save', true), array('class' => 'btn success btn-inline no-map-save'));
?>
	<div class="location-details" style="display: none; clear: both;">
	<?php
		echo $form->input('address', array('label' => __('Address', true)));
		echo '<br/>';
		echo $form->submit(__('Preview', true), array('class' => 'btn primary preview-button'));
		echo $form->submit(__('Save', true), array('class' => 'btn success map-save btn-inline')).'&nbsp;&nbsp;';
	?>
	</div>
<?php
	echo $form->end();
?>
</div>
<div class="preview">
	<?php
		$address = !empty($this->data['Location']) ? implode(',', $this->data['Location']) : '';
	?>
	<img class="preview-map" src="http://maps.googleapis.com/maps/api/staticmap?size=350x350&sensor=false&maptype=roadmap&markers=size:small|color:red|<?php echo $address ?>" />
</div>
<div style="clear: both"></div>