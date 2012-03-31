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
	
	//User to fetch data for index page
	function excerpt($slug) {
	    $site_copy = ClassRegistry::init('SiteCopy')->findBySlug($slug);
	    return $site_copy['SiteCopy']['excerpt'];
	}
	
	function body($slug) {
	    $site_copy = ClassRegistry::init('SiteCopy')->findBySlug($slug);
	    return $site_copy['SiteCopy']['body'];
	}
	
	function get_latest_everydaw_law($type) {
	    $site_copy = ClassRegistry::init('SiteCopy')->find('first',array(
            'conditions' => array('SiteCopy.type' => 'everyday_law', 'SiteCopy.published' => 1),
            'order'      => array('SiteCopy.created DESC'),
            'limit'      => 1)
	        );
	    return $site_copy['SiteCopy'][$type];
	}
	
	function get_recent_published_eveyday_law() {
	    $site_copy = $this->find('first',array(
            'conditions' => array('SiteCopy.type' => 'everyday_law', 'SiteCopy.published' => 1),
            'order'      => array('SiteCopy.created DESC'),
            'limit'      => 1)
	    );
	    return $site_copy;
	}
	
    function get_previous_published_eveyday_law($id) {
        $site_copy = $this->find('first',array(
                'conditions' => array(
                    'SiteCopy.id <'      => $id,
                    'SiteCopy.type'      => 'everyday_law',
                    'SiteCopy.published' => 1
                ),
                'limit'      => '1')
        );
        
        return $site_copy;
    }
    
    function get_next_published_eveyday_law($id) {
        $site_copy = $this->find('first',array(
                'conditions' => array(
                    'SiteCopy.id >'      => $id,
                    'SiteCopy.type'      => 'everyday_law',
                    'SiteCopy.published' => 1
                ),
                'limit'      => '1')
        );
        
        return $site_copy;
    }
}
?>