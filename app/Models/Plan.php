<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = "plans";
    protected $fillable = ['name', 'description', 'price', 'validity', 'status'];
    protected $casts = [
        'id'       => 'integer',
        'name'     => 'string',
        'description'     => 'string',
        'price' => 'decimal:6',
        'validity'     => 'integer',
        'status'   => 'integer',
    ];
}