<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysTable extends Model
{
    protected $connection = 'sqlsrv';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model', 'latest_driver',
        'latest_table_name', 'latest_id'
    ];
}
