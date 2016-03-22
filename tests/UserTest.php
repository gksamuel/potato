<?php

require_once("models/User.php");
require_once("configs/database.php");
/**
 * These are the test units for the User model
 * 
 *
 * @author samuel gachanja <gksamuel1@gmail.com>
 * @version 1.0 March 2016
 * @category test
 */
class UserTest extends PHPUnit_Framework_TestCase {

    protected function setUp() {
        $user = new User();
    }

    protected function tearDown() {
        $user = NULL;
    }

    public function testFind() {
        $user = new User;
        $user->find(4);
        $this->assertEquals(4, $user->userID);
    }

    public function testgetAll() {
        $user = new User;
        $user->getAll();
        $this->assertNotEmpty($user);
    }

    public function testSave() {
        $user = new User;
        $user->find(4);
        $lastName = rand(100, 200);
        $firstname = rand(100, 200);
        $user->lastName = $lastName;
        $user->firstName = "Josephat" . $firstname;
        $user->dateOfBirth = "1991-06-01";
        $user->save();
        $user = new User;
        $user->find(4);
        $this->assertEquals($lastName, $user->lastName);
    }

    public function testInsert() {
        $user = new User;
        $lastName = rand(100, 200);
        $firstname = rand(100, 200);
        $user->firstName = "Josephat" . $firstname;
        $user->lastName = "LastName " . $lastName;
        $user->dateOfBirth = "1991-06-01";
        $user->save();
        $this->assertGreaterThan(0, $user->userID);
    }

    public function testDestroy() {
        $user = new User;
        $firstname = rand(1000, 2000);
        $user->firstName = "Josephat " . $firstname;
        $user->lastName = "10000";
        $user->dateOfBirth = "1991-06-01";
        $user->save();
        $user->destroy($user->userID);
        $this->assertEquals(00000, $user->error[0]);
    }

}
