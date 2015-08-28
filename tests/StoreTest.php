<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    // require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        function testGetName()
        {
            //Arrange
            $store_name = "Shoe World";
            $test_store = new Store($store_name);

            //Act
            $result = $test_store->getName();

            //Assert
            $this->assertEquals($store_name, $result);
        }

        function testSetName()
        {
            //Arrange
            $store_name = "Shoe World";
            $test_store = new Store($store_name);

            //Act
            $test_store->setName("Shoe Depot");
            $result = $test_store->getName();

            //Assert
            $this->assertEquals("Shoe Depot", $result);
        }

        // function testGetId()
    }

?>
