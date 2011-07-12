<?php
class RequestReschedule extends AppModel {
    
    var $name = 'RequestReschedule';
    var $order = 'RequestReschedule.id desc';
	
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		),
	);
}
?>