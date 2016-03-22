<?php

require_once("models/Bicycle.php");
require_once("configs/database.php");
/**
 * These are the test units for the Bicycle model
 * 
 *
 * @author samuel gachanja <gksamuel1@gmail.com>
 * @version 1.0 March 2016
 * @category test
 */
class BicycleTest extends PHPUnit_Framework_TestCase {

    protected function setUp() {
        $bicycle = new Bicycle();
    }

    protected function tearDown() {
        $bicycle = NULL;
    }

    public function testFind() {
        $bicycle = new Bicycle;
        $bicycle->find(2);
        $this->assertEquals(2, $bicycle->cycleID);
    }

    public function testgetAll() {
        $bicycle = new Bicycle;
        $bicycle->getAll();
        $this->assertNotEmpty($bicycle);
    }

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

    public function testInsert() {
        $bicycle = new Bicycle;
        $rand = rand(1000, 2000);
        $bicycle->model = "Raleigh " . $rand;
        $bicycle->numberOfGears = "10000";
        $bicycle->save();
        $this->assertGreaterThan(0, $bicycle->cycleID);
    }

    public function testDuplicate() {
        $bicycle = new Bicycle;
        $bicycle->model = "Raleigh";
        $bicycle->numberOfGears = "10000";
        $bicycle->save();
        $this->assertEquals(23000, $bicycle->error[0]);
    }

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
