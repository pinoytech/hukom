<?php
class User extends AppModel {
	var $name = 'User';
	var $validate = array(
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Email must not be empty',
				'allowEmpty' => false,
				'required' => true,
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'Email must be a valid email',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
			    'rule' => 'isUnique',
                'required' => true,
                'allowEmpty' => true,
                'message' => 'This username has already been taken',
            ),
		),
		
		'type' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please select type of account',
				'allowEmpty' => false,
				'required' => true,
			)
		),
		
		'referred_by' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '',
				'allowEmpty' => true,
				'required' => false,
			)
		),
		
		/*
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Password must not be empty',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		*/
		
		'password' => array('rule' => array('confirmPassword', 'password'),
                            'message' => 'Passwords do not match'),
                            
        'password_confirm' => array('rule' => array('notempty'),
                                    'required' => true),
		'group_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
		// 'agree' => array(
		// 		           'rule' => array('comparison', '!=', 0),
		// 	               'required' => true,
		// 	               'message' => 'You must agree to the terms of use',
		// 	               'on' => 'create'
		// 	     )
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasOne = array(
        'PersonalInfo' => array(
            'className'    => 'PersonalInfo',
            'foreignKey' => 'user_id',
			'conditions'   => '',
            'dependent'    => true
        ),
		'SpouseInfo' => array(
            'className'    => 'SpouseInfo',
            'foreignKey' => 'user_id',
			'conditions'   => '',
            'dependent'    => true
        ),
		'ChildrenInfo' => array(
            'className'    => 'ChildrenInfo',
            'foreignKey' => 'user_id',
			'conditions'   => '',
            'dependent'    => true
        ),
        'CorporatePartnershipInfo' => array(
            'className'    => 'CorporatePartnershipInfo',
            'foreignKey' => 'user_id',
			'conditions'   => '',
            'dependent'    => true
        ),
    );

	var $hasMany = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ChildrenList' => array(
            'className'    => 'ChildrenList',
            'foreignKey' => 'user_id',
			'conditions'   => '',
            'dependent'    => true
        ),
		'Legalcase' => array(
			'className' => 'Legalcase',
			'foreignKey' => 'user_id',
			'dependent' => true,
		),
		'Legalcasedetail' => array(
			'className' => 'Legalcasedetail',
			'foreignKey' => 'user_id',
			'dependent' => true,
		),
		'Payment' => array(
			'className' => 'Payment',
			'foreignKey' => 'user_id',
			'dependent' => true,
		),
		'BoardOfDirector' => array(
			'className' => 'BoardOfDirector',
			'foreignKey' => 'user_id',
			'dependent' => true,
		),
		'Stockholder' => array(
			'className' => 'Stockholder',
			'foreignKey' => 'user_id',
			'dependent' => true,
		),
		'Event' => array(
			'className' => 'Event',
			'foreignKey' => 'user_id',
			'dependent' => true,
		),
		'CaseRetainer' => array(
			'className' => 'CaseRetainer',
			'foreignKey' => 'user_id',
			'dependent' => true,
		),
		'TempEvent' => array(
			'className' => 'TempEvent',
			'foreignKey' => 'user_id',
			'dependent' => true,
		),
		'RequestReschedule' => array(
			'className' => 'RequestReschedule',
			'foreignKey' => 'user_id',
			'dependent' => true,
		)
	);
	
	var $actsAs = array('Acl' => array('type' => 'requester'));

	function parentNode() {
	    if (!$this->id && empty($this->data)) {
	        return null;
	    }
	    if (isset($this->data['User']['group_id'])) {
		$groupId = $this->data['User']['group_id'];
	    } else {
	    	$groupId = $this->field('group_id');
	    }
	    if (!$groupId) {
		return null;
	    } else {
	        return array('Group' => array('id' => $groupId));
	    }
	}
	
	// Group-only ACL
	// function bindNode($user) {
	// 	    return array('Group' => array('id' => $user['User']['group_id']));
	// 	}
	
	/**    
	 * After save callback
	 *
	 * Update the aro for the user.
	 *
	 * @access public
	 * @return void
	 */
	function afterSave($created) {
		if (!$created) {
            $parent = $this->parentNode();
            $parent = $this->node($parent);
            $node = $this->node();
            $aro = $node[0];
            $aro['Aro']['parent_id'] = $parent[0]['Aro']['id'];
            $this->Aro->save($aro);
        }
	}
	
	function beforeSave() {
		if (isset($this->data['User']['admin_edit_user']) AND $this->data['User']['admin_edit_user']) {
			// Change password and hash it!
			if (isset($this->data['User']['new_password']) AND $this->data['User']['new_password']) {
				$this->data['User']['password'] = '';
				$this->data['User']['password'] = Security::hash($this->data['User']['new_password'], null, true); // A way to hash password like the Auth

			}
			else {
				// Don't update this field via saveAll :)
				unset($this->data['User']['password']);
			}
		}
		return true;
	}
	
	function confirmPassword($data) {
	    $valid = false;

        if ($data['password'] ==  Security::hash($this->data['User']['password_confirm'], null, true)) {
            $valid = true;
        }

		// Force validate for admin_edit
		if (isset($this->data['User']['admin_edit_user']) AND $this->data['User']['admin_edit_user']) {
			$valid = true;
		}
		
		return $valid;
    }
	
}
?>