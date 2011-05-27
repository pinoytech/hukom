<?php
class ChildrenInfo extends AppModel {
	var $name = 'ChildrenInfo';
	var $uses = 'children_infos';
	
	var $validate = array(
		'no_of_children' => array(
			'notempty' => array(
				'rule' => array('numeric'),
				'message' => 'Numbers Only',
				'allowEmpty' => true,
				'required' => false,
			),
		),
		
		'custody' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please select choose one',
				'allowEmpty' => true,
				'required' => false,
			)
		),
		
		// 'custody_of_children' => array(
		// 			'multiple' => array(
		// 				'rule' => array('multiple', array('in' => array('you', 'spouse', 'relative'))),
		// 	            'allowEmpty' => false,
		// 				'required' => false,
		// 	            'message' => 'Please select one, two or three options'
		// 	         ),
		// 			
		// 		),
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
		'ChildrenList' => array(
            'className'    => 'ChildrenList',
            'foreignKey'   => 'children_info_id',
			'conditions'   => '',
            'dependent'    => true
        ),
	);
}
?>