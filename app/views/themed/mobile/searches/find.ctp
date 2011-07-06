<?php
	if(empty($results) && empty($landed))
		echo $html->tag('h2', __('No results found for ', true).$this->data['Search']['query'].'.');
	if(!empty($landed)) {
		echo $form->create('Search', array('url' => array('controller' => 'searches', 'action' => 'find')));
		echo $form->input('query', array('label' => 'Search Query', 'type' => 'text', 'div' => false));
		echo $form->submit('Search', array('div' => false));
		echo $form->end();
	} else {
		if(!empty($results)) {
			$paging = $paginator->params();
	?>
	<h2>Found <?php echo $paging['count']; ?> results for &quot;<?php echo $this->data['Search']['query']; ?>&quot;.</h2>
	<br/>
	<ul data-role="listview" data-theme="c">
		<?php foreach ($results as $result) { ?>
			<li>
				<?php echo $html->link(Sanitize::html($result['ContainerItem']['body'], array('remove' => true)) . ' - ' . $result['Container']['name'], array('controller' => 'containers', 'action' => 'view', $result['Container']['slug'])); ?><br/>
				<small><?php echo $time->timeAgoInWords($result['ContainerItem']['modified']); ?></small>
			</li>
		<?php } ?>
	</ul>
	<?php
		}
	?>
	<h4 style="margin-top: 20px;">I created an item, but it doesn't show it when I search!</h4>
	<p>Please allow up to 1 minute for your item to become searchable.</p>
<?php	
	}
	