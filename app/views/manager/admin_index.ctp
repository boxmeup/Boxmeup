<h2>Admin Manager</h2>
<ul>
	<li><?php echo $html->link('Configurations', array('controller' => 'configurations', 'action' => 'index', 'admin' => true)); ?></li>
	<li><?php echo $html->link('Users', array('controller' => 'users', 'action' => 'index', 'admin' => true)); ?></li>
</ul>