<?php
	$line = array('Container Name', 'Container Slug', 'Item Description', 'Quantity', 'Created', 'Modified'); 
	$this->Csv->addRow($line);
	foreach($data['ContainerItem'] as $item) {
		$this->Csv->addRow(array(
			$data['Container']['name'],
			$data['Container']['slug'],
			$item['body'],
			$item['quantity'],
			$item['created'],
			$item['modified']
		));
	}
	echo $this->Csv->render($data['Container']['slug'] . '.csv');  