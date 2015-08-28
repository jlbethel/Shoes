<?php

    class Store {

        private $store_name;
        private $id;

        function __construct($store_name, $id = NULL)
        {

            $this->store_name = $store_name;
            $this->id = $id;
        }

        //Setter

        function setName($new_name)
        {
            $this->store_name = $new_name;
        }

        //Getters

        function getName()
        {
            return $this->store_name;
        }

        function getId()
        {
            return $this->id;
        }

        //Save and Update methods

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (store_name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function updateName($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET store_name = '{$new_name}' WHERE id = {this->getId()};");
            $this->store_name = $new_name;
        }

        //delete a single store

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
        }


        //Static Methods, note that the find method below finds a specific store, and the delete all method deletes all stores as well as store ids from join table

        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores ORDER BY store_name;");
            $stores = [];
            foreach($returned_stores as $store) {
                $store_name = $store['store_name'];
                $id = $store['id'];
                $new_store = new Store($store_name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
            $GLOBALS['DB']->exec("DELETE FROM courses_students;");
        }

        static function find($search_id)
        {
            $found_store = NULL;
            $stores = Store::getAll();
            foreach ($stores as $store) {
                $store_id = $store->getId();
                if($store_id == $search_id) {
                    $found_store = $store;
                }
            }
            return $found_store;
        }

        //methods that interact with join tables or use join statements

        function addBrand($brand)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$brand->getId()}, {$this->getId()});");
        }

        function getBrands()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores
                JOIN brands_stores ON (stores.id = brands_stores.store_id)
                JOIN brands ON (brands.id = brands_stores.brand_id)
                WHERE stores.id = {$this->getId()};");

                $brands = [];
                foreach($returned_brands as $brand) {
                    $brand_name = $brand['brand_name'];
                    $id = $brand['id'];
                    $new_brand = new Brand($brand_name, $id);
                    array_push($brands, $new_brand);
                }
                return $brands;
        }
    }

?>
