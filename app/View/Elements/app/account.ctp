<ul class="nav navbar-nav pull-right">
	<li><?php echo $this->Html->link(__('My Account'), '/account', array('class' => 'navbar-link')) ?></li>
	<li><?php echo $this->Html->link(__('Sign Out'), '/logout', array('class' => 'navbar-link')) ?></li>
</ul>
<?php
	echo $this->Form->create('Language', array('id' => 'change-language', 'url' => array('controller' => 'users', 'action' => 'change_language'), 'class' => 'navbar-form pull-right'));
	echo $this->Form->input('locale', array('id' => 'change-language-locale', 'label' => false, 'div' => false, 'class' => 'form-control', 'options' => $availableLanguages, 'empty' => __('Choose Language')));
	echo $this->Form->end();
	echo $this->Form->create('Search', array('url' => array('controller' => 'searches', 'action' => 'find'), 'autocomplete' => 'off', 'class' => 'navbar-form pull-right', 'style' => 'margin-right: 30px'));
	echo $this->Form->input('query', array('label' => false, 'type' => 'text', 'div' => false, 'autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => __('Search')));
	echo $this->Form->end();
