<?php
$this->Paginator->options(array('url' => $this->passedArgs));
$paging = $this->Paginator->params();
if ($paging['pageCount'] > 1) {
?>
<div class="paging">
 <?php echo $this->Paginator->prev('<< '.__(''), array(), null, array('class'=>'off'));?>
   <?php echo $this->Paginator->numbers(array('tag' => 'div','separator' => ''));?>
 <?php echo $this->Paginator->next(__('').' >>', array(), array(), array('class' => 'off'));?>
</div>
<?php } ?>