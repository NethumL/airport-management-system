<?php

require_once __DIR__ . '/AbstractManager.php';

class UnverifiedUserManager extends AbstractManager
{
    const TOKEN_BYTE_COUNT = 20;
    const TOKEN_VALIDITY_LENGTH = 7200;
    const MYSQL_DATETIME_FORMAT = "Y-m-d H:i:s";

    public static function addUnverifiedUser(string $email, string $name, string $password): string|false
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        if (!$password) {
            return false;
        }

        $token = bin2hex(random_bytes(self::TOKEN_BYTE_COUNT));

        $expiryTime = date(self::MYSQL_DATETIME_FORMAT, time() + self::TOKEN_VALIDITY_LENGTH);

        $stmt = self::$db->prepare("INSERT INTO unverified_user(email, name, password, token, expiryTime) VALUES(?, ?, ?, ?, ?);");
        $result = $stmt->execute([$email, $name, $password, $token, $expiryTime]);
        if ($result)
            return $token;
        else
            return false;
    }

    public static function verifyUser(string $token): bool
    {
        $stmt = self::$db->prepare("SELECT * FROM unverified_user WHERE token = ?");
        $stmt->execute([$token]);
        $result = $stmt->fetch();
        if ($result && $result["expiryTime"] > time()) {
            self::removeUser($result["email"]);
            $stmt = self::$db->prepare("INSERT INTO user(email, name, password, userType) VALUES(?, ?, ?, ?)");
            return $stmt->execute([$result["email"], $result["name"], $result["password"], $result["userType"]]);
        } else {
            return false;
        }
    }

    public static function updateVerificationToken(string $email): string|false
    {
        $user = self::getUnverifiedUserDetails($email);
        if ($user) {
            $token = bin2hex(random_bytes(self::TOKEN_BYTE_COUNT));
            $expiryTime = date(self::MYSQL_DATETIME_FORMAT, time() + self::TOKEN_VALIDITY_LENGTH);
            $stmt = self::$db->prepare("UPDATE unverified_user SET token = ?, expiryTime = ? WHERE email = ?");
            $result = $stmt->execute([$token, $expiryTime, $email]);
            if ($result)
                return $token;
            else
                return false;
        } else {
            return false;
        }
    }

    public static function getUnverifiedUserDetails(string $email): array|false
    {
        $user = self::getUnverifiedUser($email);
        if ($user) {
            return [
                'email' => $user['email'],
                'name' => $user['name'],
                'userType' => $user['userType'],
            ];
        } else {
            return false;
        }
    }

    public static function removeUser(string $email): bool
    {
        $stmt = self::$db->prepare("DELETE FROM unverified_user WHERE email = ?");
        return $stmt->execute([$email]);
    }

    private static function getUnverifiedUser(string $email): array|false
    {
        $stmt = self::$db->prepare("SELECT * FROM unverified_user WHERE email=?;");
        $stmt->execute([$email]);
        $result = $stmt->fetch();
        if ($result) {
            return [
                'email' => $result['email'],
                'name' => $result['name'],
                'password' => $result['password'],
                'userType' => $result['userType'],
                'token' => $result['token'],
                'expiryTime' => $result['expiryTime'],
            ];
        } else {
            return false;
        }
    }
}