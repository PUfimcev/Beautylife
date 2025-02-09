<?php

namespace App\Classes;

use App\Models\Product;

abstract class MainAbstractProductFilter
{


    private $productsRequest;
    public $productBuilder;

    public function __construct($builder, $query)
    {
        if(isset($query))  $this->productsRequest = $query;

        $this->productBuilder = $builder;

    }

    public function apply()
    {

        foreach($this->productFilter() as $fieldname => $value) {
            if(method_exists($this, $fieldname)) {

                $this->$fieldname($value);
            }
        }

        return $this->productBuilder;
    }


    public function productFilter()
    {
        return $this->productsRequest;
    }

}
