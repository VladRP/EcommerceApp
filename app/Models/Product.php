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

    protected $fillable = ['title',
                           'description',
                           'price',
                           'in_stock',
                           'brand',
                           'subcategory_id'
    ];

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }


}
