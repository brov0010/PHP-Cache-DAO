<?php

	/**
	 *	Abstraction class using memcache
	 *
	 * 	http://php.net/manual/en/book.memcache.php
	 */
	class CacheFactory {

		private $cache = null;

		public static function instance() {
			static $inst = null;
			if ($inst === null) {
				// This will need to be set to the doc root of the application in OpsWorks (this is specific)
				require_once($_SERVER['DOCUMENT_ROOT']."/../opsworks.php");
				$ops = new OpsWorks();
				$inst = new CacheFactory;
				$inst->cache = new Memcache;
				$inst->cache->connect($ops->memcached->host, $ops->memcached->port);		
			}
			return $inst;
		}

		/**
		 *	Make this private because we don't want anything else instantiating it.
		 *
		 */
		private function __construct() {
			
		}

		/**
		 *	Calls the cache and gets on object with its key
		 *
		 *	This could be anything from an ID, to a composite ID
		 *
		 */
		function get($key) {
			return $this->cache->get($key);
		}

		/**
		 *	Sets the cache with an objects key
		 *
		 *	Pass in the Time to Live ($ttl), to define how long the object should exists in seconds.
		 *	Default: 60 seconds
		 *	
		 *
		 */
		function set($key, $value, $ttl = 60) {
			$this->cache->set($key, $value, 0, $ttl);
		}

		/**
		 *	Deletes the cached object by key
		 *
		 *	This is especially useful when running update commands on highly available objects. For instance, user.
		 *	A user can be cached until the user is updated or deleted. Then call this method and the user will be deleted from cache.
		 *
		 */
		function delete($key) {
			$this->cache->delete($key);
		}
	}

?>