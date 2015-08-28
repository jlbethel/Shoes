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
    }

 ?>
