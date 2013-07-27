<form action="/login" class="navbar-form pull-right" style="margin-left: 20px;">
	<button type="submit" class="btn btn-primary"><?php echo __('Login') ?></button>
</form>
<?php 
	echo $this->Form->create('Language', array('id' => 'change-language', 'url' => array('controller' => 'users', 'action' => 'change_language'), 'class' => 'navbar-form pull-right'));
	echo $this->Form->input('locale', array('id' => 'change-language-locale', 'label' => false, 'div' => false, 'class' => 'form-control', 'options' => $availableLanguages, 'empty' => __('Choose Language'), 'style' => 'width: 200px;'));
	echo $this->Form->end();
?>
<ul class="nav navbar-nav pull-right">
	<li><?php echo $this->Html->link(__('Blog'), 'http://blog.boxmeupapp.com'); ?></li>
</ul>
