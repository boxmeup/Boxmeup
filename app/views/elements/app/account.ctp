<div id="auth">
	<ul>
	<?php
		if(!empty($User)) {
			echo $html->tag('li', $html->link(__('My Account', true), '/account', array('class' => 'large blue button')));
			echo $html->tag('li', $html->link(__('Sign Out', true), '/logout', array('class' => 'large orange button')));
		} else {
			echo $html->tag('li', $html->link(__('Sign Up', true), '/signup', array('class' => 'large green button ui-modal')));
			echo $html->tag('li', $html->link(__('Login', true), '/login', array('class' => 'large blue button ui-modal')));
		}
	?>
	</ul>
	<div id="language">
	<?php
		echo $form->create('Language', array('id' => 'change-language', 'url' => array('controller' => 'users', 'action' => 'change_language')));
		echo $form->input('locale', array('id' => 'change-language-locale', 'label' => false, 'options' => $availableLanguages, 'empty' => __('Choose Language', true)));
		echo $form->end();
	?>
	</div>
	<div id="search">
	<?php
		echo $form->create('Search', array('url' => array('controller' => 'searches', 'action' => 'find')));
		echo $form->input('query', array('label' => false, 'type' => 'text', 'div' => false));
		echo $form->end();
	?>
	</div>
</div>