<?php

require_once($_SERVER['DOCUMENT_ROOT']."/classes/dao/class.AbstractDao.php");

/**
 *	Class to add a cache layer to the queries. This is managed by the CacheFactory, any params pertaining to cache, should be updated there
 *
 *	The insert method will not need caching.
 */
abstract class AbstractCacheDao extends AbstractDao {

	protected function __construct() {
		parent::__construct();
		require_once($_SERVER['DOCUMENT_ROOT']."/classes/cache/class.CacheFactory.php");
	}

	/**
	 *	Assumes the $key for the cache object is the id. This key/value should be in the $params
	 *
	 */
	protected function select($query, $params = array(), $key = "id") {

		if (($result = $this->get_cache($params, $key)) != null) {
			return $result;
		}

		$result = parent::select($query, $params);
		$this->set_cache($key, $result);
		return $result;
	}

	/**
	 *	Assumes the $key for the cache object is the id. This key/value should be in the $params
	 *	Passes the object to return an object array
	 *
	 */
	protected function select_for_object($query, $object, $params = array(), $key = "id") {

		// Set this to cache the object just in case
		if (($result = $this->get_cache($params, $key."_".$object)) != null) {
			return $result;
		}

		$result = parent::select_for_object($query, $object, $params);
		$this->set_cache($key."_".$object, $result);
		return $result; 
	}

	protected function update($query, $params = array(), $key = "id") {

		parent::update($query, $params);
		CacheFactory::instance()->delete($params[$key]);
	}

	protected function delete($query, $params = array(), $key = "id") {

		parent::delete($query, $params);
		CacheFactory::instance()->delete($params[$key]);
	}

	private function get_cache($params, $key) {

		$cache_key = (array_key_exists($key, $params)) ? $params[$key] : $key;
		return CacheFactory::instance()->get($cache_key);
	}

	private function set_cache($key, $object) {

		if ($object != null) {
			CacheFactory::instance()->set($key, $object);
		}
	}

}

?>