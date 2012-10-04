<div id="auth">
	<ul>
	<?php
		if(!empty($User)) {
			echo $this->Html->tag('li', $this->Html->link(__('My Account'), '/account', array('class' => 'large blue button')));
			echo $this->Html->tag('li', $this->Html->link(__('Sign Out'), '/logout', array('class' => 'large orange button')));
		} else {
			echo $this->Html->tag('li', $this->Html->link(__('Sign Up'), '/signup', array('class' => 'large green button')));
			echo $this->Html->tag('li', $this->Html->link(__('Login'), '/login', array('class' => 'large blue button')));
		}
	?>
	</ul>
	<div id="language">
	<?php
		echo $this->Form->create('Language', array('id' => 'change-language', 'url' => array('controller' => 'users', 'action' => 'change_language')));
		echo $this->Form->input('locale', array('id' => 'change-language-locale', 'label' => false, 'options' => $availableLanguages, 'empty' => __('Choose Language')));
		echo $this->Form->end();
	?>
	</div>
</div>