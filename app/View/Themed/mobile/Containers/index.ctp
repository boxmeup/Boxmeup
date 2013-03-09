<?php
	echo $this->Html->scriptBlock("
		if(mobileApp.isAndroid()) {
			BoxmeupAndroid.loggedIn();
		}
	");
?>
<div data-role="navbar" data-type="horizontal" style="width: 100%; text-align: center" id="control-menu">
	<ul>
<?php
	echo '<li>'.$this->Html->link('Container', array('action' => 'add'), array('data-icon' => 'plus', 'data-rel' => 'dialog', 'data-role' => 'button', 'data-transition' => 'slidedown')).'</li>';
	echo '<li>'.$this->Html->link('Location', array('controller' => 'locations', 'action' => 'add'), array('data-icon' => 'plus', 'data-rel' => 'dialog', 'data-role' => 'button', 'data-transition' => 'slidedown')).'</li>';
?>
	</ul>
</div>
<br>
<ul data-role="listview" data-theme="c">
	<?php
	foreach($containers as $container) {
		echo $this->Html->tag('li',
			$this->Html->link($container['Container']['name'],
				array('controller' => 'containers', 'action' => 'view', $container['Container']['slug'])) .
			$this->Html->tag('span', $container['Container']['container_item_count'], array('class' => 'ui-li-count ui-btn-up-c ui-btn-corner-all'))
		);
	}
?>
</ul>
