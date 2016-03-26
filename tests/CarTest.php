<?php

/**
 * These are the test cases for the Car class
 * Functions specific to the Car class tests come here
 */
/**
 * @author samuel gachanja <gksamuel1@gmail.com>
 * @version 1.0 March 2016
 * @category model
 */
require_once("models/Car.php");
require_once("configs/database.php");

/**
 * Stores properties of the CarTest class
 * @class Car
 */
class CarTest extends PHPUnit_Framework_TestCase {

    /**
     * setUp method - loads Car class in preparation for tests
     */
    protected function setUp() {
        $car = new Car();
    }

    /**
     * tearDown method - Clears variables at the end of the tests.
     */
    protected function tearDown() {
        $car = NULL;
    }

    /**
     * testFind method - tests if potatoORM is able to find record
     */
    public function testFind() {
        $car = new Car;
        $car->find(25);
        $this->assertEquals(25, $car->carID);
    }

    /**
     * testgetAll method - tests fetching all records from the database
     */
    public function testgetAll() {
        $car = new Car;
        $car->getAll();
        $this->assertNotEmpty($car);
    }

    /**
     * testSave method - tests creation and updating of records
     */
    public function testSave() {
        $car = new Car;
        $car->find(25);
        $carPrice = rand(10000, 30000);
        $car->price = $carPrice;
        $car->save();
        $car = new Car;
        $car->find(25);
        $this->assertEquals($carPrice, $car->price);
    }

    /**
     * testInsert method - tests creation of record
     */
    public function testInsert() {
        $car = new Car;
        $rand = rand(1000, 2000);
        $car->name = "BMW " . $rand;
        $car->price = "10000";
        $car->save();
        $this->assertGreaterThan(0, $car->carID);
    }

    /**
     * testDuplicate method - tests whether potatoORM is able to handle
     * gracefully
     */
    public function testDuplicate() {
        $car = new Car;
        $car->name = "BMW";
        $car->price = "10000";
        $car->save();
        $this->assertEquals(23000, $car->error[0]);
    }

    /**
     * testDestroy method - deletes a record from a table
     */
    public function testDestroy() {
        $car = new Car;
        $rand = rand(1000, 2000);
        $car->name = "BMW " . $rand;
        $car->price = "10000";
        $car->save();
        $car->destroy($car->carID);
        $this->assertEquals(00000, $car->error[0]);
    }

}
