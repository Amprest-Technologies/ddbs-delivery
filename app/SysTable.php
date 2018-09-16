<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysTable extends Model
{
    /**
     * DB Connection.
     */
    protected $connection = 'sqlite';

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
