<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'title',
        'description',
        'price',
        'brand',
        'subcategory_id',
        'stock',
        'image',
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    public function cartItem()
    {
        return $this->hasOne(Cartitem::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
