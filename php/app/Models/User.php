<?php

require '../connection.php';

class User
{
    public static function list()
    {
        $connection = new Connection();
        return $connection->query("SELECT * FROM users");
    }
}
