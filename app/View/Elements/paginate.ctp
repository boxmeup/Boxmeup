<?php
$this->Paginator->options(array('url' => $this->passedArgs));
$paging = $this->Paginator->params();
if ($paging['pageCount'] > 1) {
?>
<div class="pagination">
	<li><?php echo $this->Paginator->prev('&laquo;', array('tag' => false, 'escape' => false), null, array('disabledTag' => 'a', 'escape' => false)) ?></li>
   	<?php echo $this->Paginator->numbers(array('tag' => 'li','separator' => '', 'currentClass' => 'active', 'currentTag' => 'a'));?>
	<li><?php echo $this->Paginator->next('&raquo;', array('tag' => false, 'escape' => false), null, array('disabledTag' => 'a', 'escape' => false)) ?></li>
</div>
<?php } ?>
