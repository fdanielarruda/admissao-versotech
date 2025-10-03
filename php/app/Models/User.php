<?php

require_once __DIR__ . '/../../connection.php';

class User
{
    public static function list()
    {
        $connection = new Connection();
        return $connection->query("SELECT * FROM users");
    }

    public static function find($id)
    {
        if (empty($id)) {
            return null;
        }

        $connection = new Connection();
        $pdo = $connection->getConnection();

        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$user) {
            return null;
        }

        return $user;
    }

    public static function create(array $data)
    {
        $connection = new Connection();
        $pdo = $connection->getConnection();

        $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':email', $data['email']);

        if ($stmt->execute()) {
            return $pdo->lastInsertId();
        }

        return false;
    }

    public static function syncColors(int $user_id, array $color_ids)
    {
        if (empty($color_ids)) {
            return true;
        }

        $connection = new Connection();
        $pdo = $connection->getConnection();

        $pdo->beginTransaction();

        try {
            $deleteSql = "DELETE FROM user_colors WHERE user_id = :user_id";
            $deleteStmt = $pdo->prepare($deleteSql);
            $deleteStmt->bindValue(':user_id', $user_id);
            $deleteStmt->execute();

            $sql = "INSERT INTO user_colors (user_id, color_id) VALUES (:user_id, :color_id)";
            $stmt = $pdo->prepare($sql);

            foreach ($color_ids as $color_id) {
                $stmt->bindValue(':user_id', $user_id);
                $stmt->bindValue(':color_id', $color_id);
                $stmt->execute();
            }

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            return false;
        }
    }
}
