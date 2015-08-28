<?php

    class Store {

        private $store_name;
        private $id;

        function __construct($store_name, $id = NULL) {

            $this->store_name = $store_name;
            $this->id = $id;
        }

        //Setters

        function setStoreName($new_name) {
            $this->name = $new_name;
        }



        //Getters

        function getStoreName() {
            return $this->name;
        }



    }

?>
