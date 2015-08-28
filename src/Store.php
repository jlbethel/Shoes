<?php

    class Store {

        private $store_name;
        private $id;

        function __construct($store_name, $id = NULL) {

            $this->store_name = $store_name;
            $this->id = $id;
        }

        //Setters

        function setName($new_name) {
            $this->store_name = $new_name;
        }



        //Getters

        function getName() {
            return $this->store_name;
        }



    }

?>
