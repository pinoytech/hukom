<?php
class Legalcase extends AppModel {
	var $name = 'Legalcase';
	var $useTable = 'legal_cases';
	var $order = "Legalcase.id DESC";
    // var $displayField = "CONCAT(Legalcase.id, Legalcase.legal_problem, Legalcase.created) as case_detail";
	
	var $virtualFields = array(
        'case_retainer' => "CONCAT(Legalcase.id, ' - ', Legalcase.legal_problem, ' - ', DATE(Legalcase.created))"
    );
    
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	var $hasMany = array(
		'Legalcasedetail' => array(
			'className' => 'Legalcasedetail',
			'foreignKey' => 'case_id',
			'order' => 'Legalcasedetail.id DESC',
			'dependent'    => true
		),
		'Payment' => array(
			'className' => 'Payment',
			'foreignKey' => 'case_id',
			'dependent'    => true
		),
		'Event' => array(
			'className' => 'Event',
			'foreignKey' => 'case_id',
			'dependent'    => true
		),
		'RequestReschedule' => array(
			'className' => 'RequestReschedule',
			'foreignKey' => 'case_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),

	);
	
	var $hasOne = array(
		'CaseRetainer' => array(
			'className' => 'CaseRetainer',
			'foreignKey' => 'case_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
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