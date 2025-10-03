<?php

require_once __DIR__ . '/../Models/User.php';

class UserService
{
    public static function findWithColors(int $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->user_colors_ids = User::getUserColorIds($user->id);
        }

        return $user;
    }

    public static function createAndSyncColors(string $name, string $email, array $color_ids = [])
    {
        $user_id = User::create([
            'name' => $name,
            'email' => $email
        ]);

        if ($user_id && !empty($color_ids)) {
            User::syncColors($user_id, $color_ids);
        }

        return $user_id;
    }

    public static function updateAndSyncColors(int $id, string $name, string $email, array $color_ids = [])
    {
        $user_success = User::update($id, [
            'name' => $name,
            'email' => $email
        ]);

        if (!$user_success) {
            return false;
        }

        $sync_success = User::syncColors($id, $color_ids);

        return $sync_success;
    }
}
