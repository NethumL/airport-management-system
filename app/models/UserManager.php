<?php

require_once __DIR__ . '/AbstractManager.php';

class UserManager extends AbstractManager
{
    public static function registerUser($email, $name, $password, $type): bool
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        if (!$password) {
            return false;
        }

        $stmt = self::$db->prepare("INSERT INTO user(email, name, password, userType) VALUES(?, ?, ?, ?);");
        return $stmt->execute([$email, $name, $password, $type]);
    }

    public static function updateUser($email, $name, $type): bool
    {
        $query = "UPDATE user SET name = ?, userType = ?";
        $params = [$name, $type, $email];
        $query .= " WHERE email = ?;";
        $stmt = self::$db->prepare($query);
        return $stmt->execute($params);
    }

    public static function updatePassword($email, $password): bool
    {
        $stmt = self::$db->prepare("UPDATE user SET password = ? WHERE email = ?;");
        $password = password_hash($password, PASSWORD_DEFAULT);
        return $stmt->execute([$password, $email]);
    }

    public static function removeUser($email): bool
    {
        $stmt = self::$db->prepare("DELETE FROM user WHERE email = ?");
        return $stmt->execute([$email]);
    }

    public static function getUserDetails($email): array|false
    {
        $user = self::getUser($email);
        if ($user) {
            return [
                'email' => $user['email'],
                'name' => $user['name'],
                'userType' => $user['userType']
            ];
        } else {
            return false;
        }
    }

    public static function checkCredentials($email, $password): bool
    {
        $user = self::getUser($email);
        return $user && password_verify($password, $user['password']);
    }

    public static function getUsersBy($email = '', $name = '', $type = ''): array|false
    {
        $query = "SELECT email, name, userType FROM user WHERE email LIKE ? AND name LIKE ? ";
        $params = ['%' . $email . '%', '%' . $name . '%'];
        if (!empty($type)) {
            $query .= "AND userType = ? ";
            $params[] = $type;
        }
        $query .= ";";
        $stmt = self::$db->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (gettype($result) === "array") {
            $output = array();
            foreach ($result as $row) {
                $output[] = [
                    "email" => $row["email"],
                    "name" => $row["name"],
                    "userType" => $row["userType"]
                ];
            }
            return $output;
        } else {
            return false;
        }
    }

    private static function getUser($email): array|false
    {
        $stmt = self::$db->prepare("SELECT * FROM user WHERE email=?;");
        $stmt->execute([$email]);
        $result = $stmt->fetch();
        if ($result) {
            return [
                'email' => $result['email'],
                'name' => $result['name'],
                'password' => $result['password'],
                'userType' => $result["userType"]
            ];
        } else {
            return false;
        }
    }
}
