<?php echo $html->script('jquery.showpassword', array('inline' => true)); ?>
<?php echo $html->script('views/users/signup', array('inline' => true)); ?>
<div style="width: 250px; margin: 0 auto;">
	<h2>Join Boxmeup</h2>
<?php
    echo $form->create('User', array('style' => 'width: 250px'));
    echo $form->input('email', array('style' => 'width: 250px'));
    echo $form->input('password', array('style' => 'width: 250px;'));
	echo '<br/>';
	echo $form->submit('Sign Up', array('class' => 'large green button', 'div' => false, 'style' => 'width: 260px'));
    echo $form->end();
?>
<br/>
	<p>Already have an account? <?php echo $html->link('Login!', '/login'); ?></p>
</div>
