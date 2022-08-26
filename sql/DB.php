<?php
require_once 'config.php';

class DB {
    protected $mysql;

    public function __construct()
    {
        if(file_exists('config.php')) {
            require_once('config.php');
        } 
    }

    public function getConnect() 
    {
        if($this->mysql !== NULL) {
            return $this->mysql;
        } else {
            $this->mysql = new mysqli('localhost', 'root','', 'tura');
            return $this->mysql;
        }
    }
    
    protected function close()
    {
        if($this->mysql !== NULL) {
            $this->mysql->close();
        }
    }

    protected function prepare($sql, $types, $data)
    {
        $stmt = $this->mysql->prepare($sql);
        if($types !== "") {
            $stmt->bind_param($types, ...$data);
        }
        return $stmt;
    }

    protected function prepareOne($sql, $types, $data)
    {
        $stmt = $this->mysql->prepare($sql);
        if($types !== "") {
            $stmt->bind_param($types, $data);
        }
        return $stmt;
    }
    
}
