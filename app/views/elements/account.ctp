<div id="auth">
	<ul>
	<?php
		if(!empty($User)) {
			echo $html->tag('li', $html->link('My Account', '/account', array('class' => 'large blue button')));
			if($User['is_admin'] == '1')
				echo $html->tag('li', $html->link('Admin', '/admin', array('class' => 'large red button')));
			echo $html->tag('li', $html->link('Sign Out', '/logout', array('class' => 'large orange button')));
		} else {
			echo $html->tag('li', $html->link('Sign Up', '/signup', array('class' => 'large green button ui-modal')));
			echo $html->tag('li', $html->link('Login', '/login', array('class' => 'large blue button ui-modal')));
		}
	?>
	</ul>
</div>