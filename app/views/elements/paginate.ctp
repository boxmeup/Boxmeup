<?php
$paginator->options(array('url' => $this->passedArgs));
$paging = $paginator->params();
if ($paging['pageCount'] > 0) {
?>
<div style="clear: both"></div>
<div class="paging">
 <?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'off'));?>
   <?php echo $paginator->numbers(array('tag' => 'div','separator' => ''));?>
 <?php echo $paginator->next(__('next', true).' >>', array(), array(), array('class' => 'off'));?>
</div>
<?php } ?>