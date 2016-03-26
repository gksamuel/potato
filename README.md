# INSTALLATION INSTRUCTIONS

Technologies
This application has been developed and tested on the following technologies.
Operating System: Fedora release 21
PHP Version: PHP 5.6.15
PHPUnit Version: phpunit-5.2.12
Database Version: 10.0.21-MariaDB MariaDB Server


Downloading
Download the application using the following command.
git clone https://github.com/gksamuel/potato

Database Creation
Log in to you mysql server.
Create a MySQL database using the following command.
create database DBNAME HERE;

Create a username and password for your database using the following command.
grant all privileges on DBNAME HERE.* to 'USERNAME HERE'@'HOSTNAME HERE' identified by 'PASSWORD HERE'';  

run the queries in the file andela.sql located in the database folder.
Open the file configs/database.php and edit the database credentials accordingly.

Download phpunit from  https://phpunit.de/

Run the test cases using the following commands.
 php PATH-TO-PHPUnit/phpunit-5.2.12.phar tests/CarTest.php 
 php PATH-TO-PHPUnit/phpunit-5.2.12.phar tests/BicycleTest.php 
 php PATH-TO-PHPUnit//phpunit-5.2.12.phar tests/UserTest.php 

