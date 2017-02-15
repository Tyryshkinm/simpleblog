<?php

class Model
{
    public function connectToDatabase($username = 'root', $password = '258789',
        $host = 'localhost', $dbname = 'simpleblog_db'
    ) {
        $db = new PDO("mysql:host={$host}; dbname={$dbname};", $username, $password);
        return $db;
    }
}
