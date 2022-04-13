<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'transaction_code', 'transaction_date', 'quantity', 
        'total_discount', 'total_price', 'total_checkout', 
        'item_id', 'customer_id',
    ];

    public function items()
    {
        return $this->hasMany('App\Models\Item')->order_by('id', 'ASC');
    }

    public function customers()
    {
        return $this->hasMany('App\Models\Customer')->order_by('id', 'ASC');
    }
}
