<?php
class Payment extends AppModel {
	var $name = 'Payment';
	
	// var $validate = array(
	// 		'type' => array(
	// 			'notempty' => array(
	// 				'rule' => array('notempty'),
	// 				'message' => 'Field must not be empty',
	// 				'allowEmpty' => false,
	// 				'required' => true,
	// 			),
	// 		),
	// 	);
			
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Case' => array(
			'className' => 'Case',
			'foreignKey' => 'case_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>