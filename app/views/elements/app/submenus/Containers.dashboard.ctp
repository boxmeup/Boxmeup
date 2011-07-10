<?php
	echo $this->Html->link($this->Html->image('icons/graph.png') . ' ' . __('View Activity Graph', true), array('controller' => 'containers', 'action' => 'dashboard_graph'), array('class' => 'small blue button', 'escape' => false));
	echo $this->Html->link($this->Html->image('icons/phone.png') . ' ' . __('Login Your Phone', true), array('controller' => 'users', 'action' => 'qr_login'), array('class' => 'small orange button ui-modal tip-s', 'escape' => false, 'title' => 'Login on your phone by scanning a QR Code'));
