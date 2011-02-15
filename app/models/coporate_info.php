<?php
class CorporateInfo extends AppModel {
	var $name = 'CorporateInfo';
	var $uses = 'corporate_infos';
	
	var $validate = array(
		'first_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'gender' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please select one',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'birth_date' => array(
				'rule' => array('date'),
				'message' => 'Please select valid date',
				'allowEmpty' => false,
				'required' => true,

		),
		'birth_place' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'address_ph' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'address_abroad' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'telephone_no' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'cellphone_no' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'age' => array(
			'notempty' => array(
				'rule' => array('numeric'),
				'message' => 'Numbers Only',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'citizenship' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'education_attained' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'school' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'nature_of_business' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'company_address' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'company_work' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'work_position' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'work_duration' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'work_status' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'civil_status' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'marriage_date' => array(
				'rule' => array('date'),
				'message' => 'Please select valid date',
				'allowEmpty' => false,
				'required' => true,

		),
		'marriage_place' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
	);
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
}
?>