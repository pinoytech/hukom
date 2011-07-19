<?php
class Event extends AppModel {
    
    var $name = 'Event';

    var $belongsTo = array(
    	'User' => array(
    		'className' => 'User',
    		'foreignKey' => 'user_id',
    		'conditions' => '',
    		'fields' => '',
    		'order' => ''
    	),
    	
    	'Legalcasedetail' => array(
    		'className' => 'Legalcasedetail',
    		'foreignKey' => 'case_detail_id',
    		'conditions' => '',
    		'fields' => '',
    		'order' => ''
    	),
	);
	
	
	// var $hasOne = array(
	// 	'Payment' => array(
	// 		'className' => 'Payment',
	// 		'foreignKey' => 'case_detail_id',
	// 		'conditions' => '',
	// 		'fields' => '',
	// 		'order' => ''
	// 	),
	// );
}
?>