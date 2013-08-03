<ul class="nav navbar-nav pull-right">
	<li>
		<div class="btn-group">
			<button type="button" class="btn btn-primary dropdown-toggle navbar-btn" data-toggle="dropdown">
				<?php echo __('Account') ?> <span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				<li><?php echo $this->Html->link(__('Settings'), '/account') ?></li>
				<li class="divider"></li>
				<li><?php echo $this->Html->link(__('Sign Out'), '/logout') ?></li>
			</ul>
		</div>
	</li>
</ul>
<?php
	echo $this->Form->create('Language', array('id' => 'change-language', 'url' => array('controller' => 'users', 'action' => 'change_language'), 'class' => 'navbar-form pull-right', 'style' => 'margin-right: 20px'));
	echo $this->Form->input('locale', array('id' => 'change-language-locale', 'label' => false, 'div' => false, 'class' => 'form-control', 'options' => $availableLanguages, 'empty' => __('Choose Language')));
	echo $this->Form->end();
	echo $this->Form->create('Search', array('url' => array('controller' => 'searches', 'action' => 'find'), 'autocomplete' => 'off', 'class' => 'navbar-form pull-right', 'style' => 'margin-right: 30px'));
	echo $this->Form->input('query', array('label' => false, 'type' => 'text', 'div' => false, 'autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => __('Search')));
	echo $this->Form->end();
