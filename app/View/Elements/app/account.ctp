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
	echo $this->Form->create('Language', array('id' => 'change-language', 'url' => array('controller' => 'users', 'action' => 'change_language'), 'class' => 'navbar-form navbar-right'));
	echo $this->Form->input('locale', array('id' => 'change-language-locale', 'label' => false, 'div' => false, 'class' => 'form-control', 'options' => $availableLanguages, 'empty' => __('Choose Language')));
	echo $this->Form->end();
	echo $this->Form->create('Search', array('url' => array('controller' => 'searches', 'action' => 'find'), 'autocomplete' => 'off', 'class' => 'navbar-form pull-right'));
	echo $this->Form->input('query', array('label' => false, 'type' => 'text', 'div' => false, 'autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => __('Search')));
	echo $this->Form->end();
