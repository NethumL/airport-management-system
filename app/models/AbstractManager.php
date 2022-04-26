<?php

abstract class AbstractManager
{
    protected static PDO $db;

    public static function prepare()
    {
        self::$db = DbConnectionManager::getConnection();
    }
}
