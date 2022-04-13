<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = [
        'name', 'type', 'stock', 'price', 'photo'
    ];

    public function sale()
    {
        return $this->belongsTo('App\Models\Sale');
    }
}
