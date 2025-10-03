<?php

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/Color.php';
require_once __DIR__ . '/../Services/UserService.php';
require_once __DIR__ . '/../Services/Feedback.php';

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
            Feedback::setErrorAndRedirect("Nome e e-mail são obrigatórios!", 'index.php?page=user_create');
        }

        $user_id = UserService::createAndSyncColors($name, $email, $color_ids);

        if ($user_id) {
            Feedback::setSuccessAndRedirect("Usuário {$name} cadastrado com sucesso!", 'index.php?page=users');
        } else {
            Feedback::setErrorAndRedirect("Erro ao salvar o usuário. Tente novamente.", 'index.php?page=user_create');
        }
    }

    public function edit($id)
    {
        $user = UserService::findWithColors($id);

        if ($user === null) {
            Feedback::setErrorAndRedirect("Usuário inválido ou não encontrado.", 'index.php?page=users');
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
        $redirect_error = 'index.php?page=user_edit&id=' . $id;

        if (empty($id) || empty($name) || empty($email)) {
            Feedback::setErrorAndRedirect("ID, Nome e E-mail são obrigatórios para a atualização!", $redirect_error);
        }

        $success = UserService::updateAndSyncColors($id, $name, $email, $color_ids);

        if ($success) {
            Feedback::setSuccessAndRedirect("Usuário {$name} atualizado com sucesso!", 'index.php?page=users');
        } else {
            Feedback::setErrorAndRedirect("Erro ao salvar as alterações do usuário. Tente novamente.", $redirect_error);
        }
    }

    public function delete($id)
    {
        $user = User::find($id);

        if ($user === null) {
            Feedback::setErrorAndRedirect("Usuário inválido ou não encontrado.", 'index.php?page=users');
        }

        User::delete($id);

        Feedback::setSuccessAndRedirect("Usuário {$user->name} excluído com sucesso!", 'index.php?page=users');
    }
}
