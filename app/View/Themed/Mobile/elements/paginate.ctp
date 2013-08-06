<?php
$this->Paginator->options = array('url' => $this->passedArgs);
$paging = $this->Paginator->params();
if ($paging['pageCount'] > 1) {
?>
<div data-role="controlgroup" data-type="horizontal">
	<?php
		if($this->Paginator->hasPrev()) {
			echo $this->Html->link('Previous', array_merge($this->Paginator->options['url'], array('page' => $this->Paginator->current() - 1)), array('data-role' => 'button', 'data-icon' => 'arrow-l'));
		}
		if($this->Paginator->hasNext()) {
			echo $this->Html->link('Next', array_merge($this->Paginator->options['url'], array('page' => $this->Paginator->current() + 1)), array('data-role' => 'button', 'data-icon' => 'arrow-r'));
		}

	?>
</div>
<?php } ?>