<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = ['customer_name', 'contact_number', 'order_items', 'total'];

    protected $casts = [
        'order_items' => 'array', // Convert JSON to array automatically
    ];
}
