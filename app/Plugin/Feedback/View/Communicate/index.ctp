<h2><?php echo __('Feedback') ?></h2>
<br/>
<?php
	echo $this->Form->create('Feedback', array('url' => array('plugin' => 'feedback', 'controller' => 'communicate', 'action' => 'index'), 'class' => 'form-horizontal'));
	echo $this->Form->input('location_uri', array('type' => 'hidden'));
?>
<div class="form-group">
	<label for="FeedbackFeedbackType" class="col-lg-2"><?php echo __('Feedback Type') ?></label>
	<div class="col-lg-10">
		<?php echo $this->Form->input('feedback_type', array('label' => false, 'div' => false, 'options' => array('Bug' => 'Bug', 'Feature' => 'Feature'), 'class' => 'form-control')) ?>
	</div>
</div>
<div class="form-group">
	<label for="FeedbackTitle" class="col-lg-2"><?php echo __('Title') ?></label>
	<div class="col-lg-10">
		<?php echo $this->Form->input('title', array('label' => false, 'div' => false, 'class' => 'form-control')) ?>
	</div>
</div>
<div class="form-group">
	<label for="FeedbackTitle" class="col-lg-2">&nbsp;</label>
	<div class="col-lg-10">
		<?php echo $this->Form->input('body', array('type' => 'textarea', 'label' => false, 'div' => false, 'class' => 'form-control')) ?>
		<br>
		<button type="submit" class="btn btn-success"><?php echo __('Submit Feedback') ?></button>
	</div>
</div>
<div style="display: none">
	<?php echo $this->Form->input('confirm_message'); ?>
</div>
<?php echo $this->Form->end(); ?>
