<?php
if($this->Session->check('Message.flash') || $this->Session->check('Message.auth')) {
   echo '<div id="notification">';
      $msg_type = $this->Session->check('Message.flash') ? 'flash' : 'auth';
      echo $this->Html->image('knob-message.png');
      echo $this->Session->flash($msg_type);
      echo $this->Html->tag('div', '', array('class' => 'clear'));
   echo '</div>';
}
