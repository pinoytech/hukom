<?php
class SiteCopy extends AppModel {
    var $name = 'SiteCopy';	
    
    var $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Title must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'slug' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Slug must not be empty',
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
		'body' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Body must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
	);
	
	function excerpt($slug) {
	    $site_copy = ClassRegistry::init('SiteCopy')->findBySlug($slug);
	    return $site_copy['SiteCopy']['excerpt'];
	}
		
}
?>