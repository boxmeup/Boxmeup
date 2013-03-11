<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' id='viewport' name='viewport' />
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('//ajax.aspnetcdn.com/ajax/jquery.mobile/1.3.0/jquery.mobile-1.3.0.min.css');
		echo $this->Html->script('https://www.google.com/jsapi');
		echo $this->Html->scriptBlock("google.load('jquery', '1.7.1');");
		echo $this->Html->script('//ajax.aspnetcdn.com/ajax/jquery.mobile/1.3.0/jquery.mobile-1.3.0.min.js');
		echo $this->Html->script('app.mobile');
		echo $this->element('analytics');
		echo $scripts_for_layout;
	?>

</head>
<body>
	<div data-role="page" data-theme="<?php echo Configure::read('Site.jquery_mobile_theme'); ?>" id="<?php echo $mobile_page_id; ?>">
		<div data-role="header" data-position="inline" data-add-back-btn="true">
			<a href="#left-panel" data-icon="arrow-l" data-iconshadow="false"><?=$this->Html->image('logo-tiny-icon.png')?></a>
			<h1><?php echo $title_for_layout; ?></h1>
		</div>
		<div data-role="content">
			<?php echo $content_for_layout; ?>
			<br/>
			<?php echo $this->element('paginate'); ?>
		</div>
		<div data-role="panel" id="left-panel" data-theme="a">
			<ul data-role="listview" data-theme="a">
				<?php if (!empty($User)) : ?>
					<li data-icon="grid" data-iconpos="left"><?=$this->Html->link('Containers', '/', array('data-ajax' => 'false')); ?></li>
					<li data-icon="search"><?=$this->Html->link('Search', '/searches/find', array('data-ajax' => 'false')); ?></li>
					<li data-icon="gear"><?=$this->Html->link('My Account', '/account', array('data-ajax' => 'false')); ?></li>
					<li data-icon="delete"><?=$this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout'), array('data-ajax' => 'false'));?></li>
				<?php else : ?>
					<li data-icon="home"><?=$this->Html->link('Home', '/', array('data-ajax' => 'false')); ?></li>
					<li data-icon="check"><?=$this->Html->link('Log In', '/login', array('data-ajax' => 'false')); ?></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</body>
</html>
