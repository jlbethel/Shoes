<?php

    class Store {

        private $store_name;
        private $id;

        function __construct($store_name, $id = NULL)
        {

            $this->store_name = $store_name;
            $this->id = $id;
        }

        //Setters

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


        //Static Methods
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
    }

?>
