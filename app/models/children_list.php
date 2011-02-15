<?php
class ChildrenList extends AppModel {
	var $name = 'ChildrenList';
	var $uses = 'children_lists';
	
	var $validate = array(
		// 'name' => array(
		// 			'notempty' => array(
		// 				'rule' => array('notempty'),
		// 				'message' => 'Field must not be empty',
		// 				'allowEmpty' => false,
		// 				'required' => true,
		// 			),
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
		),
		
		'ChildrenInfo' => array(
			'className' => 'ChildrenInfo',
			'foreignKey' => 'children_info_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
}
?>