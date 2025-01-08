<?php

namespace App\Classes;

use App\Models\Product;

abstract class MainAbstractProductFilter
{


    private $productsRequest;
    private $productBuilder;

    public function __construct($query)
    {
        if(isset($query))  $this->productsRequest = $query;

        $this->productBuilder = Product::query();
    }

    public function apply()
    {
        foreach($this->productBuilder() as $fieldname => $value) {
            if(method_exists($this, $fieldname)) {
                $this->$fieldname($value);
            }
        }


        return $this->productBuilder;
    }


    public function productBuilder()
    {
        return $this->productsRequest->all();
    }

}
