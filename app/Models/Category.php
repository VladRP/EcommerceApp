<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'title', 
        'description',
        'image',
    ];

    public function subCategory()
    {
        return $this->hasMany(Subcategory::class);
    }
}
