<?php if(empty($locations)): ?>
	<p><?php echo __('No locations yet.'); ?></p>
<?php 
	else:
		foreach($locations as $key => $item):
?>	
	<div class="media">
		<a class="pull-left" href="<?php echo Router::url(array('controller' => 'containers', 'action' => 'index', 'location' => $item['Location']['uuid'])) ?>" style="width: 250px; height: 100px">
			<?php if($item['Location']['is_mappable']): ?>
				<img
					 class="preview-map media-object"
					 src="http://maps.googleapis.com/maps/api/staticmap?size=250x100&amp;sensor=false&amp;maptype=roadmap&amp;markers=size:small|color:red|<?php echo $item['Location']['address']; ?>"
					 alt="<?php echo $item['Location']['address']; ?>"
					 title="<?php echo $item['Location']['address']; ?>"
				>
			<?php endif ?>
		</a>
		<div class="media-body">
			<?php echo $this->Html->link($item['Location']['name'], array('controller' => 'containers', 'action' => 'index', 'location' => $item['Location']['uuid'])); ?><br/>
			<small>Containers: <?php echo $item['Location']['container_count']; ?></small><br/>
			<?php if($item['Location']['is_mappable']) { ?><small><?php echo $item['Location']['address']; ?></small></br/><?php } ?>
			<small><?php echo $this->Time->timeAgoInWords($item['Location']['modified']); ?></small><br>
			<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'icon-edit', 'style' => 'color: black')), array('controller' => 'locations', 'action' => 'edit', $item['Location']['uuid']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'icon-remove', 'style' => 'color: black')), array('controller' => 'locations', 'action' => 'delete', $item['Location']['uuid']), array('escape' => false), __('Are you sure you want to delete this location?')); ?>
		</div>
	</div>
	<?php
		endforeach;
	endif;
