<?php
class TempEvent extends AppModel {
    
    var $name = 'TempEvent';

    var $belongsTo = array(
            'User' => array(
                'className' => 'User',
                'foreignKey' => 'user_id',
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