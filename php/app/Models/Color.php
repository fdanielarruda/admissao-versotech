<?php

require_once __DIR__ . '/../../connection.php';

class Color
{
    public static function list()
    {
        $connection = new Connection();
        return $connection->query("SELECT * FROM colors");
    }
}
