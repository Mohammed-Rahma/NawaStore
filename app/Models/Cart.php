<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Cart extends Pivot
{
    use HasFactory;
    use HasUuids; //تعرف لارفيل انه عندي حقول في جدول الكارت تستخدم uuid
    protected $table = 'carts';
    //mass 
    protected $fillable = [
        'cookie_id',
        'user_id',
        'product_id',
        'quantity'
    ];

    //بشكل تلقائي لارفيل بتعرف هذه الفنكش بس لل id 
    // public function uniqueIds()
    // {
    //     return[
    //        'id' , 'cookie_id'
    //     ];
    // }

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
