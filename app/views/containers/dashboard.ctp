<div class="widget" style="float: right; width: 200px;">
	Total Containers: <?php echo number_format($total_containers); ?><br/>
	Total Items: <?php echo number_format($total_container_items); ?>
</div>
<?php if(!empty($recent_items)) {
	echo $html->tag('h2', 'Recent Items').$html->tag('br');
	foreach($recent_items as $item) {
?>
<div class="container-item-list" >
	<span class="container-item-list-quantity">
		<?php echo $item['ContainerItem']['quantity']; ?>
	</span>
	<p class="container-item-list-content">
		<?php echo Sanitize::html($item['ContainerItem']['body'], array('remove' => true)); ?><br/>
		<?php echo $html->link($item['Container']['name'], array('controller' => 'containers', 'action' => 'view', $item['Container']['slug'])); ?><br/>
		<small><?php echo $time->timeAgoInWords($item['ContainerItem']['modified']); ?></small>
	</p>
	<div style="clear: both"></div>
</div>
<?php
	}
}
