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
</div>