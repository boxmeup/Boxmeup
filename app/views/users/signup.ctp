<?php
    echo $form->create('User');
    echo $form->input('email');
    echo $form->input('password');
    echo $form->input('confirm_password', array('type' => 'password'));
    echo $form->end('Sign Up');