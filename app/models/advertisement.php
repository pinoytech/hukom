<?php
class Advertisement extends AppModel {
    var $name = 'Advertisement';	
    
    var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Name must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'type' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Type must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
			'unique' => array(
			    'rule' => 'isUnique',
                'required' => true,
                'allowEmpty' => true,
                'message' => 'This Slug has already been taken',
            )
		),
		'code' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Code must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
	);
	
	function code($type) {
	    $code= ClassRegistry::init('Advertisement')->findByType($type);
	    return $code['Advertisement']['code'];
	}
	
}
?>
