<?php

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/Color.php';

class UserController
{
    public function index()
    {
        $users = User::list();
        include __DIR__ . '/../Views/users/index.php';
    }

    public function create()
    {
        $colors = Color::list();
        include __DIR__ . '/../Views/users/create.php';
    }

    public function store()
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $color_ids = $_POST['colors'] ?? [];

        if (empty($name) || empty($email)) {
            die("Nome e e-mail são obrigatórios!");
        }

        $user_id = User::create([
            'name' => $name,
            'email' => $email
        ]);

        if ($user_id) {
            if (!empty($color_ids)) {
                User::syncColors($user_id, $color_ids);
            }

            header('Location: index.php?page=users');
            exit;
        } else {
            die("Erro ao salvar o usuário.");
        }
    }

    public function edit($id)
    {
        $user = User::find($id);

        if ($user === null) {
            header("HTTP/1.0 404 Not Found");
            include __DIR__ . '/../Views/404.php';
            exit;
        }

        include __DIR__ . '/../Views/users/edit.php.php';
    }

    public function delete($id)
    {
        $user = User::find($id);

        if ($user === null) {
            header("HTTP/1.0 404 Not Found");
            include __DIR__ . '/../Views/404.php';
            exit;
        }

        User::delete($id);

        header('Location: index.php?page=users');
    }
}
