<?php

require_once __DIR__ . '/AbstractManager.php';

class UserManager extends AbstractManager
{
    public static function registerUser($username, $name, $password, $type): bool
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        if (!$password) {
            return false;
        }

        $stmt = self::$db->prepare("INSERT INTO user(username, name, password, user_type) VALUES(?, ?, ?, ?);");
        return $stmt->execute([$username, $name, $password, $type]);
    }

    public static function updateUser($username, $name, $type): bool
    {
        $query = "UPDATE user SET name = ?, user_type = ?";
        $params = [$name, $type, $username];
        $query .= " WHERE username = ?;";
        $stmt = self::$db->prepare($query);
        return $stmt->execute($params);
    }

    public static function updatePassword($username, $password): bool
    {
        $stmt = self::$db->prepare("UPDATE user SET password = ? WHERE username = ?;");
        $password = password_hash($password, PASSWORD_DEFAULT);
        return $stmt->execute([$password, $username]);
    }

    public static function removeUser($username): bool
    {
        $stmt = self::$db->prepare("DELETE FROM user WHERE username = ?");
        return $stmt->execute([$username]);
    }

    public static function getUserDetails($username): array|false
    {
        $user = self::getUser($username);
        if ($user) {
            return [
                'username' => $user['username'],
                'name' => $user['name'],
                'userType' => $user['userType']
            ];
        } else {
            return false;
        }
    }

    public static function checkCredentials($username, $password): bool
    {
        $user = self::getUser($username);
        return $user && password_verify($password, $user['password']);
    }

    public static function getUsersBy($username = '', $name = '', $type = ''): array|false
    {
        $query = "SELECT username, name, user_type FROM user WHERE username LIKE ? AND name LIKE ? ";
        $params = ['%' . $username . '%', '%' . $name . '%'];
        if (!empty($type)) {
            $query .= "AND user_type = ? ";
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
                    "username" => $row["username"],
                    "name" => $row["name"],
                    "userType" => $row["user_type"]
                ];
            }
            return $output;
        } else {
            return false;
        }
    }

    private static function getUser($username): array|false
    {
        $stmt = self::$db->prepare("SELECT * FROM user WHERE username=?;");
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        if ($result) {
            return [
                'username' => $result['username'],
                'name' => $result['name'],
                'password' => $result['password'],
                'userType' => $result["user_type"]
            ];
        } else {
            return false;
        }
    }
}
