<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\Item;
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

    public function item()
    {
        return $this->hasOne('App\Models\Item', 'id', 'item_id')->orderBy('id', 'ASC');
    }

    public function customer()
    {
        return $this->hasOne('App\Models\Customer', 'id', 'customer_id')->orderBy('id', 'ASC');
    }
}
