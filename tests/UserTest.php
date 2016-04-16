<?php

/**
 * These are the test cases for the User class
 * Functions specific to the User class tests come here
 */
/**
 * @author samuel gachanja <gksamuel1@gmail.com>
 * @version 1.0 March 2016
 * @category model
 */
require_once("models/User.php");
require_once("configs/database.php");

/**
 * Stores properties of the UserTest class
 * @class UserTest
 */
class UserTest extends PHPUnit_Framework_TestCase {

    /**
     * setUp method - loads User class in preparation for tests
     */
    protected function setUp() {
        $user = new User();
    }

    /**
     * tearDown method - Clears variables at the end of the tests.
     */
    protected function tearDown() {
        $user = NULL;
    }

    /**
     * testFind method - tests if potatoORM is able to find record
     */
    public function testFind() {
        $user = new User;
        $user->find(4);
        $this->assertEquals(4, $user->userID);
    }

    /**
     * testgetAll method - tests fetching all records from the database
     */
    public function testgetAll() {
        $user = new User;
        $user->getAll();
        $this->assertNotEmpty($user);
    }

    /**
     * testSave method - tests creation and updating of records
     */
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

    /**
     * testInsert method - tests creation of record
     */
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

    /**
     * testDestroy method - deletes a record from a table
     */
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
