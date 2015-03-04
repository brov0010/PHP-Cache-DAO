<?php

/**
 *	All high level queries should run through this class so as to abstract
 *
 */
abstract class AbstractDao {

	private $conn = null;

	/**
	 *	must be instantiated first.  
	 *
	 *
	 */
	protected function __construct() {
		// This will need to be set to the doc root of the application in OpsWorks (this is specific)
		require_once($_SERVER['DOCUMENT_ROOT']."/../opsworks.php");
		$ops = new OpsWorks();
		$this->conn = new PDO("mysql:host=".$ops->db->host.";dbname=".$ops->db->database, $ops->db->username, $ops->db->password);
	}

	/**
	 *
	 *	Queries should pass a null object and params in the array with key value being within the query
	 *
	 *	Ex: $query = "SELECT first_name, $last_name from Person where id = :id", $params = new array('id' => 1)
	 *
	 *	Simply returns an associative array
	 *	TODO: Implement a selectForObject method which binds a POPO
	 */
	protected function select($query, $params = array()) {

		$statement->execute($query, $params);
		return $statement->fetchAll(PDO::FETCH_ASSOC); 
	}

	/**
	 *
	 *	Queries should pass a null object and params in the array with key value being within the query
	 *
	 *	Ex: $query = "SELECT first_name, $last_name from Person where id = :id", $params = new array('id' => 1)
	 *
	 *	Returns a bound object array
	 */
	protected function select_for_object($query, $object, $params = array()) {

		$statement = $this->execute($query, $params);
		return $statement->fetchAll(PDO::FETCH_CLASS, $object); 
	}

	/**
	 *
	 *
	 */
	protected function insert($query, $params = array()) {

		return $this->execute($query, $params);
	}

	protected function update($query, $params = array()) {

		return $this->execute($query, $params);
	}

	protected function delete($query, $params = array()) {
		
		return $this->execute($query, $params);
	}

	/**
	 *	Simple method to bind a prepare statement to a query with named parameters
	 *
	 */
	protected final function execute($query, $params = array()) {

		$statement = $this->conn->prepare($query);
		$statement->execute($params);
		return $statement;
	}
}


?>