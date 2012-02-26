<div id="auth">
	<ul>
	<?php
		if(!empty($User)) {
			echo $html->tag('li', $html->link('My Account', '/account', array('class' => 'large blue button')));
			echo $html->tag('li', $html->link('Sign Out', '/logout', array('class' => 'large orange button')));
		} else {
			echo $html->tag('li', $html->link('Sign Up', '/signup', array('class' => 'large green button ui-modal')));
			echo $html->tag('li', $html->link('Login', '/login', array('class' => 'large blue button ui-modal')));
		}
	?>
	</ul>
	<div id="search">
	<?php
		echo $form->create('Search', array('url' => array('controller' => 'searches', 'action' => 'find')));
		echo $form->input('query', array('label' => false, 'type' => 'text', 'div' => false));
		echo $form->end();
	?>
	</div>
</div>