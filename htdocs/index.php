<?php
	
	require_once($_SERVER['DOCUMENT_ROOT']."/classes/dao/user/class.UserDao.php");

	$user_dao = new UserDao;
	// $params = array("first_name" => "Chad", "last_name" => "Brovold", "email" => "chad.brovold@jostens.com", "password" => "testing");
	// $user_dao->create(new User($params));
	$users = $user_dao->get_by_id(2);

	// $users = $user_dao->destroy(13);

	header("Content-type: application/json");
	echo json_encode($users);
?>
