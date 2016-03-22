<?php
require_once("models/Car.php");
require_once("configs/database.php");

/**
 * These are the test units for the Car model
 * 
 *
 * @author samuel gachanja <gksamuel1@gmail.com>
 * @version 1.0 March 2016
 * @category test
 */

class CarTest extends PHPUnit_Framework_TestCase {

    protected function setUp() {
        $car = new Car();
    }

    protected function tearDown() {
        $car = NULL;
    }

    public function testFind() {
        $car = new Car;
        $car->find(25);
        $this->assertEquals(25, $car->carID);
    }

    public function testgetAll() {
        $car = new Car;
        $car->getAll();
        $this->assertNotEmpty($car);
    }

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

    public function testInsert() {
        $car = new Car;
        $rand = rand(1000, 2000);
        $car->name = "BMW " . $rand;
        $car->price = "10000";
        $car->save();
        $this->assertGreaterThan(0, $car->carID);
    }

    public function testDuplicate() {
        $car = new Car;
        $car->name = "BMW";
        $car->price = "10000";
        $car->save();
        $this->assertEquals(23000, $car->error[0]);
    }

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
