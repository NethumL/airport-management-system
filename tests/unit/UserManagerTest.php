<?php

require_once __DIR__ . "/AbstractManagerTest.php";
require_once __DIR__ . "/../../app/models/UserManager.php";

final class UserManagerTest extends AbstractManagerTest
{
    public function testRegisterUser()
    {
        $testUser = self::$testUsers[0];
        UserManager::registerUser($testUser["email"], $testUser["name"], $testUser["password"], $testUser["userType"]);
        $stmt = $this->db->prepare("SELECT * FROM user WHERE email = ?;");
        $stmt->execute([$testUser['email']]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($testUser['email'], $result['email']);
        $this->assertEquals($testUser['name'], $result['name']);
        $this->assertTrue(password_verify($testUser['password'], $result['password']));
        $this->assertEquals($testUser['userType'], $result['userType']);
    }
}
