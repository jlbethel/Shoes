<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Brand.php";

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

        //Setter test
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

        //Getter tests
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

        //Save and Update Store Name tests

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

        function testUpdateName()
        {
            //Arrange
            $store_name = "Shoe World";
            $test_store = new Store($store_name);
            $test_store->save();

            $store_name2 = "Shoe Deopt" ;
            $test_store->updateName($store_name2);

            //Act
            $id = $test_store->getId();
            $result = new Store($store_name, $id);

            //Assert
            $this->assertEquals(Store::find($id), $result);
        }

        //Test for deleting a single store
        function test_delete()
        {
            //Arrange
            $store_name = "Shoe World";
            $test_store = new Store($store_name);
            $test_store->save();

            $store_name2 = "Shoe Deopt" ;
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            //Act
            $test_store->delete();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store2], $result);
        }

        //Static method tests
        function test_getAll()
        {
            //Arrange
            $store_name = "Shoe World";
            $test_store = new Store($store_name);
            $test_store->save();

            $store_name2 = "Shoe Deopt" ;
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store2, $test_store], $result);
        }

        function test_deleteAll()
        {
            $store_name = "Shoe World";
            $test_store = new Store($store_name);
            $test_store->save();

            $store_name2 = "Shoe Deopt" ;
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            //Act
            Store::deleteAll();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $store_name = "Shoe World";
            $test_store = new Store($store_name);
            $test_store->save();

            $store_name2 = "Shoe Deopt" ;
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            //Act
            $result = Store::find($test_store->getId());

            //Assert
            $this->assertEquals($test_store, $result);
        }

        //tests methods that interact with join tables or use join statements

        function test_addBrand()
        {
            //Assert
            $brand_name = "La Sportiva";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            $store_name = "Shoe World";
            $test_store = new Store($store_name);
            $test_store->save();

            //Act
            $result = [$test_brand];
            $test_store->addBrand($test_brand);

            //Assert
            $this->assertEquals($test_store->getBrands(), $result);
        }

    }

?>
