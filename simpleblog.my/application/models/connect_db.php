<?php

try {
    $connect_bd = new PDO('mysql:host=localhost; dbname=simpleblog_db', 'root', '258789');
}
catch (PDOException $e) {
    echo "Can not connect to the database";
}

?>