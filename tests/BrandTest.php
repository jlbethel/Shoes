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

    }
?>
