<?php
	if(empty($results) && empty($landed))
		echo $this->Html->tag('h2', __('No results found for ').$this->request->data['Search']['query'].'.');
	if(!empty($landed)) {
		echo $this->Form->create('Search', array('url' => array('controller' => 'searches', 'action' => 'find')));
		echo $this->Form->input('query', array('label' => 'Search Query', 'type' => 'text', 'div' => false));
		echo $this->Form->submit('Search', array('div' => false));
		echo $this->Form->end();
	} else {
		if(!empty($results)) {
			$paging = $this->Paginator->params();
	?>
	<h2>Found <?php echo $paging['count']; ?> results for &quot;<?php echo $this->request->data['Search']['query']; ?>&quot;.</h2>
	<br/>
	<ul data-role="listview" data-theme="c">
		<?php foreach ($results as $result) { ?>
			<li>
				<?php echo $this->Html->link(Sanitize::html($result['ContainerItem']['body'], array('remove' => true)) . ' - ' . $result['Container']['name'], array('controller' => 'containers', 'action' => 'view', $result['Container']['slug'])); ?><br/>
				<small><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$this->Time->timeAgoInWords($result['ContainerItem']['modified']); ?></small>
			</li>
		<?php } ?>
	</ul>
	<?php
		}
	?>
	<h4 style="padding-top: 20px;">I created an item, but it doesn't show it when I search!</h4>
	<p>Please allow up to 1 minute for your item to become searchable.</p>
<?php	
	}
	
