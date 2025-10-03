<?php

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/Color.php';
require_once __DIR__ . '/../Services/UserService.php';

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

        $user_id = UserService::createAndSyncColors($name, $email, $color_ids);

        if ($user_id) {
            header('Location: index.php?page=users');
            exit;
        } else {
            die("Erro ao salvar o usuário.");
        }
    }

    public function edit($id)
    {
        $user = UserService::findWithColors($id);

        if ($user === null) {
            header("HTTP/1.0 404 Not Found");
            include __DIR__ . '/../Views/404.php';
            exit;
        }

        $colors = Color::list();
        $user_colors = $user->user_colors_ids;

        include __DIR__ . '/../Views/users/edit.php';
    }

    public function update()
    {
        $id = $_POST['id'] ?? 0;
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $color_ids = $_POST['colors'] ?? [];

        if (empty($id) || empty($name) || empty($email)) {
            die("ID, Nome e E-mail são obrigatórios para a atualização!");
        }

        $success = UserService::updateAndSyncColors($id, $name, $email, $color_ids);

        if ($success) {
            header('Location: index.php?page=users&message=updated');
            exit;
        } else {
            die("Erro ao salvar as alterações do usuário.");
        }
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
