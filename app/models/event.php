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
);
}
?>