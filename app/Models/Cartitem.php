<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartitem extends Model
{
    use HasFactory;

    protected $table = 'cartitems';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'product_id', 
        'quantity', 
        'total_price', 
        'user_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
