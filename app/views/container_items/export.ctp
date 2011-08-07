<?php
	$line = array('Container Name', 'Container Slug', 'Item Description', 'Quantity', 'Created', 'Modified'); 
	$this->Csv->addRow($line);
	foreach($data as $item) {
		$this->Csv->addRow(array(
			$item['Container']['name'],
			$item['Container']['slug'],
			$item['ContainerItem']['body'],
			$item['ContainerItem']['quantity'],
			$item['ContainerItem']['created'],
			$item['ContainerItem']['modified']
		));
	}
	echo $this->Csv->render('complete_inventory_' . date('Y_m_d') . '.csv');  