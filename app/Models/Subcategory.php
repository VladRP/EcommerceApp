<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'title', 
        'description', 
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
