<?php
	if (empty($User)) {
		echo $this->Html->link(__('Login'), '/login', array('class' => 'btn btn-primary navbar-btn navbar-right'));
	} else {
?>
<ul class="nav navbar-nav navbar-right">
	<li>
		<div class="btn-group">
			<button type="button" class="btn btn-primary dropdown-toggle navbar-btn" data-toggle="dropdown">
				<i class="icon-user" style="margin-right: 5px"></i> <?php echo __('Account') ?> <span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				<li><a href="/account"><i class="icon-gears"></i> <?php echo __('Settings') ?></a></li>
				<li><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'auth')) ?>"><i class="icon-lock"></i> <?php echo __('Applications') ?></a></li>
				<li class="divider"></li>
				<li><a href="/logout"><i class="icon-off"></i> <?php echo __('Sign Out') ?></a></li>
			</ul>
		</div>
	</li>
</ul>
<?php 
	}
?>
<ul class="nav navbar-nav navbar-right" style="margin-right: 20px;">
	<li><?php echo $this->Html->link(__('Blog'), 'http://blog.boxmeupapp.com'); ?></li>
</ul>