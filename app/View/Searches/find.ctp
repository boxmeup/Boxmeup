<?php
	if(empty($results))
		echo $this->Html->tag('h2', __('No results found for ').$this->request->data['Search']['query'].'.');
	else {
		$paging = $this->Paginator->params();
?>
<h2>Found <?php echo $paging['count']; ?> results for &quot;<?php echo $this->request->data['Search']['query']; ?>&quot;.</h2>
<br/>
	<div class="list-group">
	<?php foreach ($results as $result): ?>
		<a href="<?php echo Router::url(array('controller' => 'containers', 'action' => 'view', $result['Container']['slug'])) ?>" class="list-group-item">
			<p><?php echo Sanitize::html($result['ContainerItem']['body'], array('remove' => true)); ?></p>
			<p>
				<?php echo $result['Container']['name']; ?>
				(<small><?php echo $this->Time->timeAgoInWords($result['ContainerItem']['modified']); ?></small>)
			</p>
		</a>
	<?php endforeach ?>
	</div>
<?php
	}
?>
<h4 style="margin-top: 20px;"><?php echo __("I created an item, but it doesn't show it when I search!"); ?></h4>
<p><?php echo __('Please allow up to 1 minute for your item to become searchable.'); ?></p>
