<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    public $timestamps = True;

    protected $fillable = [
        'product_name', 'product_desc', 'price', 'product_code', 'product_img', 'product_type'
    ];
}
