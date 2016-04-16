<?php
/**
 * This is a sandbox file for testing the functionality of potatoORM class
 * Comment/Uncomment/Edit according to your requirements
 */

/**
 *
 * @author samuel gachanja <gksamuel1@gmail.com>
 * @version 1.0 March 2016
 * @category model
 */
require_once("models/User.php");
require_once("models/Car.php");
require_once("library/PotatoORM.php");
require_once("models/Bicycle.php");
require_once("configs/database.php");



$user = new User;

$user->firstName = "Samuel";
$user->lastName = "Gachanja";
$user->dateOfBirth = "1982-02-01";
$user->save();
$user->find(1); 
$user->firstName = "Wellington";
$user->lastName = "Wanjala";
$user->dateOfBirth = "1922-02-01";
$user->save();

$user->getAll();
print_r($user);
$user->destroy(27) or die("Could not delete user");



$car = new Car;
$car->getAll() or die("Could not fetch records");
//print_r($car);
$rand = rand(1000, 2000);
$car->find(110) or die("Could not find Car");
$car->name = "BMW " . $rand;
$car->price = "10000";
$car->save();

//$car->destroy($car->carID) or die ("Could not delete Car");

/*
$bicycle = new Bicycle;
//$bicycle->model = "Peugeot";
//$bicycle->numberOfGears = 10;
//$bicycle->save();
$bicycle->getAll();
//print_r($bicycle);
*/


