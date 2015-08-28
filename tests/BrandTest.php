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

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            // Brand::deleteAll();
            Store::deleteAll();
        }

        //Setter test
        function testSetName()
        {
            //Arrange
            $brand_name = "La Sportiva";
            $test_brand = new Brand($brand_name);

            //Act
            $test_brand->setName("Evolv");
            $result = $test_brand->getName();

            //Assert
            $this->assertEquals("Evolv", $result);
        }

        //Getter tests
        function testGetName()
        {
            //Arrange
            $brand_name = "La Sportiva";
            $test_brand = new Brand($brand_name);

            //Act
            $result = $test_brand->getName();

            //Assert
            $this->assertEquals($brand_name, $result);
        }

        function testGetId()
        {
            //Arrange
            $brand_name = "La Sportiva";
            $id = 1;
            $test_brand = new Brand($brand_name, $id);

            //Act
            $result = $test_brand->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        //Save and Update Brand name tests

        function testSave()
        {
            //Arrange
            $brand_name = "La Sportiva";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals($test_brand, $result[0]);
        }

        //Static Method tests
        function test_getAll();
        {
            $brand_name = "La Sportiva";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            $brand_name2 = "Evolv";
            $test_brand2 = new Brand($brand_name2);
            $test_brand2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_brand2, $test_store], $result);
        }

        function test_deleteAll()
        {
            $brand_name = "La Sportiva";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            $brand_name2 = "Evolv";
            $test_brand2 = new Brand($brand_name2);
            $test_brand2->save();

            //Act
            Brand::deleteAll()
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([], $result);

        }

    }
?>
