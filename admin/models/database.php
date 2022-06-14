<?php

class Database
{
    public $host;
    public $user;
    public $pass;
    public $dbname;

    public mysqli $conn;

    public function __construct($host = 'localhost', $user = 'root', $pass = '', $dbname = 'test')
    {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->dbname = $dbname;
    }
    public function connect()
    {
        if (!isset($this->conn)){
            $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        }
        return $this->conn;
    }

    /**
     * @throws Exception
     */
    public function query($query)
    {
        if($result = $this->connect()->query($query)){
            return $result;
        }
        if ($this->connect()->errno) {
            throw new Exception('Error: '.$this->conn->error);
        }
    }

}