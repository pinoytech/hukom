<?php
class Payment extends AppModel {
	var $name = 'Payment';
	var $useTable = false;
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	/*
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		),
		'Legalcase' => array(
			'className' => 'Legalcase',
			'foreignKey' => 'case_id',
		),
	);
	
	var $hasOne = array(
		'Bankdeposit' => array(
			'className' => 'Bankdeposit',
			'foreignKey' => 'payment_id',
		),
	);
	*/
}
?>