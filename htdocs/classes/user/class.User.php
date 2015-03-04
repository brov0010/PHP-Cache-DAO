<?php

class User {

	public $id = null;
	public $first_name = null;
	public $last_name = null;
	public $email = null;
	public $password = null;
	public $is_active = false;

	public function __construct($params = array()) {
		if (count($params) == 0) {
			return;
		}
		$this->id = $params['id'];
		$this->first_name = $params['first_name'];
		$this->last_name = $params['last_name'];
		$this->email = $params['email'];
		$this->password = (array_key_exists("password", $params)) ? $params['password'] : false;
		$this->active = (array_key_exists("is_active", $params)) ? $params['is_active'] : false;
	}

}

?>