<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = "subscriptions";
    protected $fillable = ['user_id', 'plan', 'amount', 'validity', 'start_date', 'end_date'];
    protected $casts = [
        'id'       => 'integer',
        'user_id'  => 'integer',
        'plan'     => 'string',
        'amount'   => 'decimal:6',
        'validity' => 'integer',
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

}