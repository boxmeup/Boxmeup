<?php
	if(isset($control)) {
?>
<div id="control">
<?php
		echo $this->element('app/controls/'.$control);
?>
</div>
<?php
	}
?>