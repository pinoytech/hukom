<?php
class CorporatePartnershipInfo extends AppModel {
	var $name = 'CorporatePartnershipInfo';
	
	var $validate = array(
		'company_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'type' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'principal_office_address' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'business_address' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'line_of_business' => array(
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
	
	var $hasMany = array(
		'BoardOfDirector' => array(
			'className' => 'BoardOfDirector',
			'foreignKey' => 'corporate_partnership_info_id',
			'dependent' => true,
		),
		'Stockholder' => array(
			'className' => 'Stockholder',
			'foreignKey' => 'corporate_partnership_info_id',
			'dependent' => true,
		)
	);
	
	function parentNode(){
	    
	}
    
}
?>