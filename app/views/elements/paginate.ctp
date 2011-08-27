<?php
$paginator->options(array('url' => $this->passedArgs));
$paging = $paginator->params();
if ($paging['pageCount'] > 1) {
?>
<div class="paging">
 <?php echo $paginator->prev('<< '.__('', true), array(), null, array('class'=>'off'));?>
   <?php echo $paginator->numbers(array('tag' => 'div','separator' => ''));?>
 <?php echo $paginator->next(__('', true).' >>', array(), array(), array('class' => 'off'));?>
</div>
<?php } ?>