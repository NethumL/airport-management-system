<?php

require_once __DIR__ . '/AbstractManager.php';

class PasswordResetManager extends AbstractManager
{
    const TOKEN_BYTE_COUNT = 20;
    const TOKEN_VALIDITY_LENGTH = 7200;
    const MYSQL_DATETIME_FORMAT = "Y-m-d H:i:s";

    public static function addPasswordReset(string $email): string|false
    {
        $token = bin2hex(random_bytes(self::TOKEN_BYTE_COUNT));

        $expiryTime = date(self::MYSQL_DATETIME_FORMAT, time() + self::TOKEN_VALIDITY_LENGTH);

        $stmt = self::$db->prepare("INSERT INTO password_reset(email, token, expiryTime) VALUES(?, ?, ?);");
        $result = $stmt->execute([$email, $token, $expiryTime]);
        if ($result)
            return $token;
        else
            return false;
    }

    public static function getEmailForToken(string $token): string|false
    {
        $stmt = self::$db->prepare("SELECT email FROM password_reset WHERE token = ?");
        $stmt->execute([$token]);
        return $stmt->fetchColumn();
    }

    public static function verifyToken(string $token, bool $invalidate): bool
    {
        $stmt = self::$db->prepare("SELECT * FROM password_reset WHERE token = ?");
        $stmt->execute([$token]);
        $result = $stmt->fetch();
        if ($result && $result["expiryTime"] > time()) {
            if ($invalidate)
                return self::invalidateToken($token);
            else
                return true;
        } else {
            return false;
        }
    }

    public static function invalidateToken(string $token): bool
    {
        $stmt = self::$db->prepare("DELETE FROM password_reset WHERE token = ?");
        return $stmt->execute([$token]);
    }
}