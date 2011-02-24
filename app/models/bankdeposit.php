<?php
class Bankdeposit extends AppModel {
	var $name = 'Bankdeposit';
	var $useTable = 'bank_deposits';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	var $validate = array(
		'bank' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field is required',
				'allowEmpty' => false,
				'required' => true,
			)
		),
		'branch' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field is required',
				'allowEmpty' => false,
				'required' => true,
			)
		),
		'date_deposited' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field is required',
				'allowEmpty' => false,
				'required' => true,
			)
		),
		'country' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field is required',
				'allowEmpty' => false,
				'required' => true,
			)
		),
		'amount' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field is required',
				'allowEmpty' => false,
				'required' => true,
			)
		),
		'reference_no' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field is required',
				'allowEmpty' => false,
				'required' => true,
			)
		),
	);
	
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
}
?>