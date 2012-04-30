<?php
// app/Model/User.php


	
class User extends AppModel {
    public $name = 'User';
	public $hasMany = 'Post';
    public $validate = array(
	
	      
		  
		 
          
	       'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            ),
			 
		  'login' => array(
                'rule' => 'isUnique',
                'message' => 'This username has already been taken.'
            ),
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );
	
	
	
	
	public function beforeSave() {
    if (isset($this->data[$this->alias]['password'])) {
        $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
    }
    return true;
}
	
	
	
	
}