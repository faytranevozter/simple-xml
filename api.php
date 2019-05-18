<?php
function array_to_xml($data, &$xml_data) {
	foreach($data as $key => $value) {
		if(is_numeric($key)){
			$key = 'item' . $key; //dealing with <0/>..<n/> issues
		}

		if(is_array($value)) {
			$subnode = $xml_data->addChild($key);
			array_to_xml($value, $subnode);
		} else {
			$xml_data->addChild($key, htmlspecialchars($value));
		}
	}
}

function edit($nama='', $email='', $alamat='') {
	$data = [
		'nama' => $nama,
		'email' => $email,
		'alamat' => $alamat,
	];

	$xml_data = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><biodata></biodata>');
	array_to_xml($data, $xml_data);
	$xml_data->asXML('data.xml');
}

edit(@$_POST['form-nama'], @$_POST['form-email'], @$_POST['form-alamat']);
