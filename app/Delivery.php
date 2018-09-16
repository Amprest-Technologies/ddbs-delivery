<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'delivery_no', 'sender_id', 'recipient_id',
        'agent_id', 'delivery_status',
    ];
}
