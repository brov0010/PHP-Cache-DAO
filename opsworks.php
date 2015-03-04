<?php
class OpsWorksDb {
  public $adapter, $database, $encoding, $host, $username, $password, $reconnect;

  public function __construct() {
    $this->type = 'mysql';
    $this->data_source_provider = '';
    $this->adapter = '';
    $this->database = 'dao_test';
    $this->encoding = 'utf8';
    $this->host = 'localhost';
    $this->username = 'root';
    $this->password = '';
    $this->reconnect = 'true';
  }
}

class OpsWorksMemcached {
  public $host, $port;

  public function __construct() {
    $this->host = 'localhost';
    $this->port = '11211';
  }
}

class OpsWorks {
  public $db, $memcached, $stack_name;
  private $stack_map;

  public function __construct() {
    $this->db = new OpsWorksDb();
    $this->memcached = new OpsWorksMemcached();
    $this->stack_map = array();
    $this->stack_name = '';
  }

  public function layers() {
    return array_keys($this->stack_map);
  }

  public function hosts($layer) {
    return $this->stack_map[$layer];
  }
}
