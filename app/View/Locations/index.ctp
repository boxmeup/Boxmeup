<?php
	echo $this->Html->scriptBlock("
		$(document).ready(function() {
			boxmeup.optionHoverSetup();
			boxmeup.optionHide();
		});
	");
	if(empty($locations)) {
?>
<p><?php echo __('No locations yet.'); ?></p>
<?php } else { ?>
		<?php
			foreach($locations as $key => $item) {
		?>	
				<div class="container-item-list" >
					<span class="container-item-list-map">
						<?php if($item['Location']['is_mappable']) { ?>
						<img
							 class="preview-map tip-s"
							 src="http://maps.googleapis.com/maps/api/staticmap?size=250x100&amp;sensor=false&amp;maptype=roadmap&amp;markers=size:small|color:red|<?php echo $item['Location']['address']; ?>"
							 alt="<?php echo $item['Location']['address']; ?>"
							 title="<?php echo $item['Location']['address']; ?>"
						>
						<?php } else { ?>
						&nbsp;
						<?php } ?>
					</span>
					<p class="container-item-list-content-short">
						<?php echo $this->Html->link($item['Location']['name'], array('controller' => 'containers', 'action' => 'index', 'location' => $item['Location']['uuid'])); ?><br/>
						<small>Containers: <?php echo $item['Location']['container_count']; ?></small><br/>
						<?php if($item['Location']['is_mappable']) { ?><small><?php echo $item['Location']['address']; ?></small></br/><?php } ?>
						<small><?php echo $this->Time->timeAgoInWords($item['Location']['modified']); ?></small>
					</p>
					<div class="container-item-list-options">
						<?php echo $this->Html->link($this->Html->image('icons/edit.png'), array('controller' => 'locations', 'action' => 'edit', $item['Location']['uuid']), array('escape' => false)); ?>
						<?php echo $this->Html->link($this->Html->image('icons/delete.png'), array('controller' => 'locations', 'action' => 'delete', $item['Location']['uuid']), array('escape' => false), __('Are you sure you want to delete this location?')); ?>
					</div>
					<div style="clear: both"></div>
				</div>
		<?php
			}
	}
