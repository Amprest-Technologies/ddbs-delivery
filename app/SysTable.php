<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysTable extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model','driver',
        'table_name','latest_id',
    ];
}
