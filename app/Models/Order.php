<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'sum',
    ];

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('quantity','price','sum');
    }

    public function user (){
        return $this->belogsToMany(User::class);
    }
}
