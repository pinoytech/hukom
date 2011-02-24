<?php
class Legalcasedetail extends AppModel {
	var $name = 'Legalcasedetail';
	var $useTable = 'legal_case_details';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Legalcase' => array(
			'className' => 'Legalcase',
			'foreignKey' => 'case_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);	
	
	var $hasMany = array(
		'Legalcasedetail' => array(
			'className' => 'Legalcasedetail',
			'foreignKey' => 'case_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
}
?>