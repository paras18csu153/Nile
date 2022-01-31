<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = "order_product";

    public function insertMultiple($data){
        OrderProduct::insert($data);
    }
}
