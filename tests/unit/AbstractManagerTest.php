<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../../app/core/DbConnectionManager.php";
require_once __DIR__ . "/../../app/models/AbstractManager.php";

class AbstractManagerTest extends TestCase
{
    protected static array $dbConfig;
    protected PDO $db;

    protected static array $testUsers = [
        ["email" => "john", "name" => "John Doe", "password" => "password123", "userType" => "CUSTOMER"]
    ];

    public static function setUpBeforeClass(): void
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
        $dotenv->safeLoad();
        self::$dbConfig = [
            'host' => $_SERVER["DB_HOST"],
            'user' => $_SERVER["DB_USER"],
            'password' => $_SERVER["DB_PASSWORD"],
            'database' => $_SERVER["DB_DATABASE"],
        ];
    }

    public function setUp(): void
    {
        $this->prepareDbConnection();
        $this->db->exec("CREATE DATABASE IF NOT EXISTS " . self::$dbConfig['database']);
        $this->db->exec("USE " . self::$dbConfig['database']);
        $query = file_get_contents(__DIR__ . "/../../schema.sql");
        $this->db->exec($this->removeDelimiterStatements($query));

        $tmp = $this->db;
        Closure::bind(static function () use ($tmp) {
            DbConnectionManager::$handler = $tmp;
        }, null, DbConnectionManager::class)();
        AbstractManager::prepare();
    }

    public function testConnection()
    {
        $stmt = $this->db->query("SELECT 1");
        $stmt->execute();
        $result = $stmt->fetchColumn();
        $this->assertEquals(1, $result);
    }

    public function tearDown(): void
    {
        $query = "DROP DATABASE " . self::$dbConfig['database'];
        $this->db->exec($query);
    }

    protected function prepareDbConnection()
    {
        if (isset($this->db)) return;
        try {
            $this->db = new PDO(
                'mysql:host=' . self::$dbConfig['host'],
                self::$dbConfig['user'],
                self::$dbConfig['password']
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
            die();
        }
    }

    private function removeDelimiterStatements(string $query): string
    {
        $lines = preg_split("/\r\n|\n|\r/", $query);
        $cleaned = array_map(function (string $line) {
            if (str_contains($line, "DELIMITER")) {  // Remove `DELIMITER` statements
                return '';
            } else if (str_contains($line, "$$")) {  // Replace delimiter
                return preg_replace("/\\$\\$/", ";", $line);
            } else {
                return $line;
            }
        }, $lines);
        return implode("\n", $cleaned);
    }
}
