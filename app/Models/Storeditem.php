<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storeditem extends Model
{
    use HasFactory;

    protected $table = 'storeditems';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'order_id',
        'stored_item_name', 
        'stored_item_quantity', 
        'stored_item_total_price'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
