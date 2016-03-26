<?php
/**
 * These are the test cases for the Bicycle class
 * Functions specific to the Bicycle class tests come here
 */
/**
 * @author samuel gachanja <gksamuel1@gmail.com>
 * @version 1.0 March 2016
 * @category model
 */
require_once("models/Bicycle.php");
require_once("configs/database.php");

/**
 * Stores properties of the BicycleTest class
 * @class Car
 */
class BicycleTest extends PHPUnit_Framework_TestCase {

    /**
     * setUp method - loads Bicycle class in preparation for tests
     */
    protected function setUp() {
        $bicycle = new Bicycle();
    }

    /**
     * tearDown method - Clears variables at the end of the tests.
     */
    protected function tearDown() {
        $bicycle = NULL;
    }

    /**
     * testFind method - tests if potatoORM is able to find record
     */
    public function testFind() {
        $bicycle = new Bicycle;
        $bicycle->find(2);
        $this->assertEquals(2, $bicycle->cycleID);
    }

    /**
     * testgetAll method - tests fetching all records from the database
     */
    public function testgetAll() {
        $bicycle = new Bicycle;
        $bicycle->getAll();
        $this->assertNotEmpty($bicycle);
    }

    /**
     * testSave method - tests creation and updating of records
     */
    public function testSave() {
        $bicycle = new Bicycle;
        $bicycle->find(2);
        $bicyclePrice = rand(10000, 30000);
        $bicycle->numberOfGears = $bicyclePrice;
        $bicycle->save();
        $bicycle = new Bicycle;
        $bicycle->find(2);
        $this->assertEquals($bicyclePrice, $bicycle->numberOfGears);
    }

    /**
     * testInsert method - tests creation of record
     */
    public function testInsert() {
        $bicycle = new Bicycle;
        $rand = rand(1000, 2000);
        $bicycle->model = "Raleigh " . $rand;
        $bicycle->numberOfGears = "10000";
        $bicycle->save();
        $this->assertGreaterThan(0, $bicycle->cycleID);
    }

    /**
     * testDuplicate method - tests whether potatoORM is able to handle
     * gracefully
     */
    public function testDuplicate() {
        $bicycle = new Bicycle;
        $bicycle->model = "Raleigh";
        $bicycle->numberOfGears = "10000";
        $bicycle->save();
        $this->assertEquals(23000, $bicycle->error[0]);
    }

    /**
     * testDestroy method - deletes a record from a table
     */
    public function testDestroy() {
        $bicycle = new Bicycle;
        $rand = rand(1000, 2000);
        $bicycle->model = "Raleigh " . $rand;
        $bicycle->numberOfGears = "10000";
        $bicycle->save();
        $bicycle->destroy($bicycle->cycleID);
        $this->assertEquals(00000, $bicycle->error[0]);
    }

}
