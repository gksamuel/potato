<?php

/**
 * This is a stub model class for Car
 * Functions specific to the Car class come here
 */
/**
 * @author samuel gachanja <gksamuel1@gmail.com>
 * @version 1.0 March 2016
 * @category model
 */
require_once 'library/PotatoORM.php';

/**
 * Stores properties of the Car class
 * Functions specific to Class car come in this file.
 * @class Car
 */
class Car extends PotatoORM {

    /**
     *
     * @var type carID is the primary key for the Car class
     */
    public $carID;

    /**
     *
     * @var type name stores the name of the car
     */
    public $name;

    /**
     * @var type price stores the price of the car
     */
    public $price;

}
