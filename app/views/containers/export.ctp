<?php
	$line = array(
		__('Container Name', true),
		__('Container Slug', true),
		__('Item Description', true),
		__('Quantity', true),
		__('Created', true),
		__('Modified', true)
	); 
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