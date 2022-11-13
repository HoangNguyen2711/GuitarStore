<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'status',
        'total',
        'ship',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'note',
        'payment',
        'product_id',
        'quantity',
        'size'
    ];

    public function getWithPaginateBy($userId)
    {
        return $this->whereUserId($userId)->latest('id')->paginate(10);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


}
