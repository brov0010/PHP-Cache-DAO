<?php

require_once($_SERVER['DOCUMENT_ROOT']."/classes/dao/class.AbstractCacheDao.php");
require_once($_SERVER['DOCUMENT_ROOT']."/classes/user/class.User.php");

class UserDao extends AbstractCacheDao {
	
	public function __construct() {
		parent::__construct();
	}

	function create($user) {

		$params = array('first_name' => $user->first_name, 'last_name' => $user->last_name, 'email' => $user->email, 'password' => $user->password);
		parent::insert("INSERT INTO users(first_name, last_name, email, password) VALUES(:first_name, :last_name, :email, PASSWORD(:password))", $params);
	}

	function update_by_user($user) {

		$params = array('id' => $user->id, 'first_name' => $user->first_name, 'last_name' => $user->last_name, 'email' => $user->email);
		parent::update("UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email WHERE id = :id", $params);	
	}

	function get_all() {

		return parent::select_for_object("SELECT id, first_name, last_name, email, is_active FROM users", "user", array(), "users");
	}

	// FIXME: look for a little better pattern for selecting single objects
	function get_by_id($id) {

		$result = null;
		$results = parent::select_for_object("SELECT id, first_name, last_name, email, is_active FROM users WHERE id = :id", "user", array("id" => $id));
		if (count($results) > 0) {
			$result = $results[0];
		}
		return $result;
	}

	function destroy($id) {

		parent::delete("DELETE FROM users WHERE id = :id", array("id" => $id));
	}

}

?>