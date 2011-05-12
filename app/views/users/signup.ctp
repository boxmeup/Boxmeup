<div style="width: 250px; margin: 0 auto;">
	<h2>Join Boxmeup</h2>
<?php
    echo $form->create('User', array('style' => 'width: 200px'));
    echo $form->input('email', array('style' => 'width: 200px'));
    echo $form->input('password', array('style' => 'width: 200px'));
    echo $form->input('confirm_password', array('type' => 'password', 'style' => 'width: 200px; margin-bottom: 10px'));
	echo $form->submit('Sign Up', array('class' => 'large green button', 'div' => false, 'style' => 'width: 210px'));
    echo $form->end();
?>
<br/>
	<p>Already have an account? <?php echo $html->link('Login!', '/login'); ?></p>
</div>
