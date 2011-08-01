<?php
class CaseRetainer extends AppModel {
    
    var $name = 'CaseRetainer';
    // var $order = 'RequestReschedule.id desc';
	
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