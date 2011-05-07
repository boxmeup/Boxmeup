<?php
	if(empty($results))
		echo $html->tag('h2', __('No results found for ', true).$this->data['Search']['query'].'.');
	else {
		$paging = $paginator->params();
?>
<h2>Found <?php echo $paging['count']; ?> results for &quot;<?php echo $this->data['Search']['query']; ?>&quot;.</h2>
<br/>
		<?php foreach ($results as $result) { ?>
			<div class="container-item-list" >
				<p class="container-item-list-content">
					<?php echo Sanitize::html($result['ContainerItem']['body'], array('remove' => true)); ?><br/>
					<?php echo $html->link($result['Container']['name'], array('controller' => 'containers', 'action' => 'view', $result['Container']['slug'])); ?><br/>
					<small><?php echo $time->timeAgoInWords($result['ContainerItem']['modified']); ?></small>
				</p>
				<div style="clear: both"></div>
			</div>
		<?php } ?>
<?php
	}
?>
<h4 style="margin-top: 20px;">I created an item, but it doesn't show it when I search!</h4>
<p>Please allow up to 1 minute for your item to become searchable.</p>