<?php
class Legalcasedetail extends AppModel {
	var $name = 'Legalcasedetail';
	var $useTable = 'legal_case_details';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	var $validate = array(
		'id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'case_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'legal_service' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'status' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'summary' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'objectives' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'questions' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
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