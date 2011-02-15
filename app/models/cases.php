<?php
class Case extends AppModel {
	var $name = 'Case';
	
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
		)
	);
	
	//Same client with same case with new question
	//Case has many questions, summary and facts 
}
?>