<?php

class model
{
    public function connect_to_db($username = 'root', $password = '258789', $host = 'localhost', $dbname = 'simpleblog_db')
    {
        $db = new PDO("mysql:host={$host}; dbname={$dbname};", $username, $password);
        return $db;
    }
}
