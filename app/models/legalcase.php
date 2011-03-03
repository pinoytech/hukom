<?php
class Legalcase extends AppModel {
	var $name = 'Legalcase';
	var $useTable = 'legal_cases';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	var $hasMany = array(
		'Legalcasedetail' => array(
			'className' => 'Legalcasedetail',
			'foreignKey' => 'case_id',
			'order' => 'Legalcasedetail.id DESC',
			'dependent'    => true
		),
		'Bankdeposit' => array(
			'className' => 'Bankdeposit',
			'foreignKey' => 'case_id',
			'dependent'    => true
		),
	);
	
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	
	);	
}
?>