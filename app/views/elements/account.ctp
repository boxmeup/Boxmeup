<div id="account">
	<ul>
	<?php
		if(!empty($User)) {
			echo $html->tag('li', $html->link('My Account', '/account'));
			if($User['is_admin'] == '1')
				echo $html->tag('li', $html->link('Admin', '/admin', array('style' => 'float: right')));
			echo $html->tag('li', $html->link('Sign Out', '/logout'));
		} else {
			echo $html->tag('li', $html->link('Sign Up', '/signup'));
			echo $html->tag('li', $html->link('Login', '/login'));
		}
	?>
	</ul>
</div>