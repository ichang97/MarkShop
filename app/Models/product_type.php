<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_type extends Model
{
    use HasFactory;

    public $timestamps = False;

    protected $fillable = 'type_name';
}
