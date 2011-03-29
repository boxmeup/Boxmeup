<?php
	if(empty($results))
		echo $html->tag('h2', __('No results found for ', true).$this->data['Search']['query'].'.');
	else {
		$paging = $paginator->params();
?>
<h2>Found <?php echo $paging['count']; ?> results for &quot;<?php echo $this->data['Search']['query']; ?>&quot;.</h2>
<br/>
<table class="search-results" style="width: 100%">
	<thead>
		<?php echo $html->tableHeaders(array('Item', 'Container', 'Modified')); ?>
	</thead>
	<tbody>
		<?php
		foreach ($results as $result)  {
			echo $html->tableCells(array(
				$result['ContainerItem']['body'],
				$html->link($result['Container']['name'], array('controller' => 'containers', 'action' => 'view', $result['Container']['slug'])),
				$time->niceShort($result['ContainerItem']['modified'])
			), array('class' => 'alternate'));
		}
		?>
	</tbody>
</table>
<?php
	}
?>
<h4 style="margin-top: 20px;">I created an item, but it doesn't show it when I search!</h4>
<p>Please allow up to 1 minute for your item to become searchable.</p>