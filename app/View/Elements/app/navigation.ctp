<?php
	if(!isset($active))
		$active = '';
	$menu = array(
		'containers.dashboard' => array(
			'icon' => 'icon-dashboard',
			'label' => __('Dashboard'),
			'link' => '/dashboard',
		),
		'containers.index' => array(
			'icon' => 'icon-inbox',
			'label' => __('My Containers'),
			'link' => array('controller' => 'containers', 'action' => 'index')
		),
		'container_items.index' => array(
			'icon' => 'icon-tasks',
			'label' => __('My Items'),
			'link' => array('controller' => 'container_items', 'action' => 'index')
		),
		'locations.index' => array(
			'icon' => 'icon-location-arrow',
			'label' => __('My Locations'),
			'link' => array('controller' => 'locations', 'action' => 'index')
		)
	);
	$quick = array(
		array(
			'url' => Router::url(array('controller' => 'users', 'action' => 'qr_login')),
			'icon' => 'icon-qrcode',
			'color' => 'black',
			'label' => __('Login Your Phone')
		),
		array(
			'url' => Router::url(array('controller' => 'containers', 'action' => 'add')),
			'icon' => 'icon-plus-sign',
			'color' => 'green',
			'label' => __('Add Container')
		)
	);
?>
<div class="well well-small main-navigation">
	<ul class="nav nav-pills nav-stacked">
	<?php foreach($menu as $path => $link): ?>
		<li>
			<a href="<?php echo Router::url($link['link']) ?>"><i class="<?php echo $link['icon'] ?>" style="color: black; margin-right: 15px"></i><?php echo $link['label'] ?></a>
		</li>
	<?php endforeach ?>
		<li style="border-top:1px solid #ddd"></li>
		<li class="dropdown-header"><?php echo __('Quick Actions') ?></li>
	<?php foreach ($quick as $link): ?>
		<li>
			<a data-toggle="modal" data-target="#layout-modal" href="<?php echo $link['url'] ?>">
				<i class="<?php echo $link['icon'] ?>" style="color: <?php echo $link['color'] ?>; margin-right: 15px"></i><?php echo $link['label'] ?>
			</a>
		</li>
	<?php endforeach ?>
	</ul>
</div>
