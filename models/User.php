<?php
/**
 * This is a stub model class for User
 * Functions specific to the User class come here
 */
/**
 * @author samuel gachanja <gksamuel1@gmail.com>
 * @version 1.0 March 2016
 * @category model
 */
require_once 'library/PotatoORM.php';

/**
 * Stores properties of the User class
 * Functions specific to Class User come in this file.
 * @class User
 */
class User extends PotatoORM {

    /**
     *
     * @var type userID is the primary key for the User class
     */
    public $userID;
    
    /**
     *
     * @var type firstName the user's first name
     */
    public $firstName;
    
    /**
     *
     * @var type lastName is the user's last name
     */
    public $lastName;
    
    /**
     *
     * @var type dateOfBirth is the user's date of birth
     */
    public $dateOfBirth;

}
