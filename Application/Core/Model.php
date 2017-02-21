<?php

class Model
{
    public $db;
    public $sth;
    public function __construct($username = 'root', $password = '258789',
        $host = 'localhost', $dbname = 'simpleblog_db'
    ) {
        $this->db = new PDO("mysql:host={$host}; dbname={$dbname};", $username, $password);
    }

    public function executeQuery($query)
    {
        $this->sth = $this->db->prepare($query);
        $this->sth->execute();
    }
}