<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'transaction_code', 'transaction_data', 'quantity', 
        'total_discount', 'total_price', 'total_checkout', 
        'item_id', 'customer_id',
    ];
}
