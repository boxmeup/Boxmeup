<?php
	echo $this->Html->script('views/locations/add', array('inline' => false));
?>
<h2><?php echo __('Add Location'); ?></h2>
<div class="row">
	<div class="col-lg-7">
		<?php echo $this->Form->create('Location', array('url' => array('controller' => 'locations', 'action' => 'add'), 'class' => 'form-horizontal')); ?>
		<div class="form-group">
			<label for="LocationName" class="col-lg-2"><?php echo __('Name') ?></label>
			<div class="col-lg-10">
				<?php echo $this->Form->input('name', array('label' => false, 'div' => false, 'class' => 'form-control')); ?>
				<br>
				<button type="submit" class="btn btn-success no-map-save"><?php echo __('Save') ?></button>
				<button type="submit" class="btn btn-primary attach-map"><?php echo __('Attach a Map') ?></button>
			</div>
		</div>
		<div class="form-group location-details" style="display: none">
			<label for="LocationAddress" class="col-lg-2"><?php echo __('Address') ?></label>
			<div class="col-lg-10">
				<?php echo $this->Form->input('address', array('label' => false, 'div' => false, 'class' => 'form-control')); ?>
				<br>
				<button type="submit" class="btn btn-success preview-button"><?php echo __('Preview') ?></button>
				<button type="submit" class="btn btn-primary map-save"><?php echo __('Attach a Map') ?></button>
			</div>
		</div>
	</div>
<?php
	echo $this->Form->end();
?>
	<div class="col-lg-5 well well-small">
	<?php
		$address = !empty($this->request->data['Location']) ? implode(',', $this->request->data['Location']) : '';
	?>
		<img class="preview-map" src="http://maps.googleapis.com/maps/api/staticmap?size=350x350&sensor=false&maptype=roadmap&markers=size:small|color:red|<?php echo $address ?>" />
	</div>
</div>
