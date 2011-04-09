<?php
$paginator->options(array('url' => $this->passedArgs));
$paging = $paginator->params();
if ($paging['pageCount'] > 1) {
?>
<div data-role="controlgroup" data-type="horizontal">
	<?php
		if($paginator->hasPrev()) {
			echo $html->link('Previous', array_merge($paginator->options['url'], array('page' => $paginator->current() - 1)), array('data-role' => 'button', 'data-icon' => 'arrow-l'));
		}
		if($paginator->hasNext()) {
			echo $html->link('Next', array_merge($paginator->options['url'], array('page' => $paginator->current() + 1)), array('data-role' => 'button', 'data-icon' => 'arrow-r'));
		}

	?>
</div>
<?php } ?>