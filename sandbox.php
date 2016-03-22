<?php
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

//$user->getAll();
print_r($user);
//$user->destroy(2);



$car = new Car;
//$rand = rand(1000, 2000);
//$car->name = "BMW " . $rand;
//$car->price = "10000";
//$car->save();
$car->find(78);
$car->destroy(78);
//print_r($car);


$bicycle = new Bicycle;
//$bicycle->model = "Peugeot";
//$bicycle->numberOfGears = 10;
//$bicycle->save();
$bicycle->getAll();
//print_r($bicycle);



