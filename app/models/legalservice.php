<?php
class Legalservice extends AppModel {
	var $name = 'Legalservice';
	var $useTable = 'legal_services';
	
	var $validate = array(
		'name' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => 'Field must not be empty',
					'allowEmpty' => false,
					'required' => true,
				),
			),
		'fee' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => 'Field must not be empty',
					'allowEmpty' => false,
					'required' => true,
				),
			),
	);
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

}
?>