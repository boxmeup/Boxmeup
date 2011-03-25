Total Containers: <?php echo number_format($total_containers); ?><br/>
Total Containers Items: <?php echo number_format($total_container_items); ?>
<?php
	echo $this->GChart->start('containers_trend');
	echo $this->GChart->visualize('containers_trend', $container_graph);
?>