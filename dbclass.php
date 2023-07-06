<?php
define('SERVER', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'test');

class DBCLass {
    private $mysqli;
    private static $instance;
    protected function __construct()
	{
        $this->mysqli = new mysqli("localhost", "root", "", "test");
        if ($this->mysqli->connect_errno) {
            printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
            exit();
        }

	}
    public function q($sql = ''){
        if ($result = $this->mysqli->query($sql)){
            return $result;
        }
    }
    public function sqlOne($sql = ''){
        if ($result = $this->mysqli->query($sql)){
            return $result->fetch_row();
        }
    }
    public function insert($sql = ''){
        if ($this->mysqli->query($sql)) return $this->mysqli->insert_id;
        else return false;
    }
 
    public static function getInstance()
    {
        $cls = static::class;
        if (!isset(self::$instance[$cls])) {
            self::$instance[$cls] = new static();
        }
        return self::$instance[$cls];
    }
    protected function __clone() { }
    public function __wakeup(){throw new \Exception("Cannot unserialize a singleton.");}
}

