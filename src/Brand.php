<?php

    class Brand {

        private $brand_name;
        private $id;

        function __construct($brand_name, $id = NULL)
        {
            $this->brand_name = $brand_name;
            $this->id = $id;
        }

        //Setter

        function setName($new_name)
        {
            $this->brand_name = $new_name;
        }

        //Getters

        function getName()
        {
            return $this->brand_name;
        }

        function getId()
        {
            return $this->id;
        }

        //Save

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (brand_name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        //Static methods, note that the find method finds a specific brand

        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands ORDER BY brand_name;");
            $brands = [];
            foreach($returned_brands as $brand) {
                $brand_name = $brand['brand_name'];
                $id = $brand['id'];
                $new_brand = new Brand($brand_name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
        }

        static function find($search_id)
        {
            $found_brand = NULL;
            $brands = Brand::getALL();
            foreach ($brands as $brand) {
                $brand_id = $brand->getId();
                if($brand_id == $search_id) {
                    $found_brand = $brand;
                }
            }
            return $found_brand;
        }
    }

 ?>
