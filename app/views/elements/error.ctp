<?php
if($session->check('Message.flash') || $session->check('Message.auth')) {
   echo '<div id="notification">';
      $msg_type = $session->check('Message.flash') ? 'flash' : 'auth';
      echo $html->image('knob-message.png');
      echo $session->flash($msg_type);
      echo $html->tag('div', '', array('class' => 'clear'));
   echo '</div>';
}
