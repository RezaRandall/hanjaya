<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_item_master_model extends Model
{
    protected $table = 'order_item_master_model';
    protected $fillable = [
        'product_id',
        'customer_name',
        'phone',
        'address',
        'item_name',
        'qty',
        'uom',
        'item_price',
        'total_price',
        'status',
        'log_date_time'
    ];
}
