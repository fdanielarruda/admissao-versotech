<?php

require_once __DIR__ . '/../../connection.php';

class User
{
    public static function list()
    {
        $connection = new Connection();
        return $connection->query("SELECT * FROM users");
    }

    public static function find(int $id)
    {
        if (empty($id)) {
            return null;
        }

        $pdo = (new Connection())->getConnection();

        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_OBJ);

        return $user ?: null;
    }

    public static function create(array $data)
    {
        $pdo = (new Connection())->getConnection();

        $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':email', $data['email']);

        if ($stmt->execute()) {
            return (int)$pdo->lastInsertId();
        }

        return false;
    }

    public static function getUserColorIds(int $user_id)
    {
        $pdo = (new Connection())->getConnection();

        $sql = "SELECT color_id FROM user_colors WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    }

    public static function syncColors(int $user_id, array $color_ids)
    {
        $pdo = (new Connection())->getConnection();
        $pdo->beginTransaction();

        try {
            $deleteSql = "DELETE FROM user_colors WHERE user_id = :user_id";
            $deleteStmt = $pdo->prepare($deleteSql);
            $deleteStmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $deleteStmt->execute();

            if (!empty($color_ids)) {
                $insertSql = "INSERT INTO user_colors (user_id, color_id) VALUES (:user_id, :color_id)";
                $insertStmt = $pdo->prepare($insertSql);

                foreach (array_unique($color_ids) as $color_id) {
                    $insertStmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
                    $insertStmt->bindValue(':color_id', $color_id, PDO::PARAM_INT);
                    $insertStmt->execute();
                }
            }

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            return false;
        }
    }

    public static function update(int $id, array $data)
    {
        if (empty($id) || empty($data['name']) || empty($data['email'])) {
            return false;
        }

        $pdo = (new Connection())->getConnection();

        $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':email', $data['email']);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function delete(int $id)
    {
        if (empty($id)) {
            return false;
        }

        $pdo = (new Connection())->getConnection();

        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $success = $stmt->execute();

            return $success && $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
}
