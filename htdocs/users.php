<?php
	
	require_once($_SERVER['DOCUMENT_ROOT']."/classes/dao/user/class.UserDao.php");

	$user_dao = new UserDao;
	$result = null;

	switch ($_SERVER['REQUEST_METHOD']) {
		case "POST":

			$user_dao->create(new User($_POST));
			header("HTTP/1.1 201 Created");
			break;
		case "GET":

			if (!isset($_GET['id']) || empty($_GET['id'])) {
				$result = $user_dao->get_all();
			} else {
				$result = $user_dao->get_by_id($_GET['id']);
			}
			if ($result == null) {
				header("HTTP/1.1 404 Not Found");
				exit;
			}
			break;
		case "PUT":

			parse_str(file_get_contents('php://input'), $post_vars);
			$user_dao->update_by_user(new User($post_vars));
			header("HTTP/1.1 204 No Content");
			break;
		case "DELETE":

			$user_dao->destroy($_GET['id']);
			header("HTTP/1.1 204 No Content");
			break;
		default:

			header("HTTP/1.1 403 Method Not Allowed");
			break;
	}

	header("Content-type: application/json");
	if ($result) {
		echo json_encode($result);
	}
?>