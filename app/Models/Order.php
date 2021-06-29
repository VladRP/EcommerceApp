<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;
    
    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'user_id', 
        'total_price', 
        'payment_method'
    ];
    
    public function storeditems()
    {
        return $this->hasMany(Storeditem::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
