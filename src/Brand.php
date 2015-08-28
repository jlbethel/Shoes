<?php

    class Brand {

        private $brand_name;
        private $id;

        function __construct($brand_name, $id = NULL)
        {
            $this->brand_name = $brand_name;
            $this->id = $id;
        }
    }

 ?>
