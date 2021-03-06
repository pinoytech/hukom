<?php
class Payment extends AppModel {
	var $name = 'Payment';

    var $validate = array(
        'option' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '',
				'allowEmpty' => false,
				'required' => false,
			)
		),
		'status' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '',
				'allowEmpty' => false,
				'required' => false,
			)
		),
		'bank_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '',
				'allowEmpty' => false,
				'required' => false,
			)
		),
    	'bank_date_deposited' => array(
    		'notempty' => array(
    			'rule' => array('notempty'),
    			'message' => '',
    			'allowEmpty' => false,
    			'required' => false,
    		)
    	),
        'bank_branch' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => '',
                'allowEmpty' => false,
                'required' => false,
            )
        ),
        'bank_country' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => '',
                'allowEmpty' => false,
                'required' => false,
            )
        ),
		'gcash_type' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '',
				'allowEmpty' => false,
				'required' => false,
			)
		),
		'smartmoney_type' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '',
				'allowEmpty' => false,
				'required' => false,
			)
		),
    	'reference_no' => array(
    		'notempty' => array(
    			'rule' => array('notempty'),
    			'message' => '',
				'allowEmpty' => true,
				'required' => false,
    		)
    	),
        'cellphone_no' => array(
    		'notempty' => array(
    			'rule' => array('notempty'),
    			'message' => '',
				'allowEmpty' => false,
				'required' => false,
    		)
    	),
	    'amount' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '',
				'allowEmpty' => false,
				'required' => false,
			)
		),
		'check_cash_date_of_pick_up' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '',
				'allowEmpty' => false,
				'required' => false,
			)
		),
	    'check_cash_date_of_pick_up' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '',
				'allowEmpty' => false,
				'required' => false,
			)
		),
		'check_cash_address' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '',
				'allowEmpty' => false,
				'required' => false,
			)
		),
		'check_cash_contact_person' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '',
				'allowEmpty' => false,
				'required' => false,
			)
		),
		'telephone_no' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '',
				'allowEmpty' => false,
				'required' => false,
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
		'Legalcasedetail' => array(
			'className' => 'Legalcasedetail',
			'foreignKey' => 'case_detail_id',
		),
	);
	
}
?>