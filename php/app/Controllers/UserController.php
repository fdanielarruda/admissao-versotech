<?php

require_once __DIR__ . '/../Models/User.php';

class UserController
{
    public function index()
    {
        $users = User::list();
        include __DIR__ . '/../Views/users.php';
    }
}
