<?php
	echo $this->GChart->start('containers_trend');
	echo $this->GChart->visualize('containers_trend', $container_graph);
