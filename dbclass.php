<?php
define('SERVER', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'test');

class DBCLass {
    private $mysqli;
	function __construct()
	{
        $this->mysqli = new mysqli("localhost", "root", "", "test");

        /* проверка соединения */
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
}

