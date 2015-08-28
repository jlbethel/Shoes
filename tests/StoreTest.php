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
        protected function tearDown()
        {
            Store::deleteAll();
        }

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

        function testGetId()
        {
            //Arrange
            $store_name = "Shoe World";
            $id = 1;
            $test_store = new Store($store_name, $id);

            //Act
            $result = $test_store->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function testSave()
        {
            //Arrange
            $store_name = "Shoe World";
            $test_store = new Store($store_name);
            $test_store->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals($test_store, $result[0]);
        }

        function test_getALl()
        {
            //Arrange
            $store_name = "Shoe World";
            $test_store = new Store($store_name);
            $test_store->save();

            $store_name2 = "Shoe Deopt" ;
            $test_store2 = new Store($store_name);
            $test_store2->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store2, $test_store], $result);
        }

    }

?>
