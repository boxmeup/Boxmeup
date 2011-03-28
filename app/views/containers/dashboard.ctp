<div class="widget" style="float: right; width: 200px;">
	Total Containers: <?php echo number_format($total_containers); ?><br/>
	Total Items: <?php echo number_format($total_container_items); ?>
</div>
<div style="float: right; margin-right: 10px; width: 440px;">
	<?php
	if(!empty($recent_items)) {
		echo $html->tag('h4', 'Recent Items').$html->tag('br');
		foreach($recent_items as $item) {
			echo $item['ContainerItem']['body'];
			echo $html->tag('p',
				$html->link($item['Container']['name'], array('action' => 'view', $item['Container']['slug'])) . ' - ' .
				$time->timeAgoInWords($item['ContainerItem']['created']), array('style' => 'text-align: right', 'class' => 'hint')
			);
		}
	}
	?>
</div>
<div style="clear: both; padding: 5px 0; border-bottom: 1px dotted #ccc;"></div>
<?php
	echo $this->GChart->start('containers_trend');
	echo $this->GChart->visualize('containers_trend', $container_graph);
?>