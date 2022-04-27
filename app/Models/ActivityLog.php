<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_logs';
    protected $fillable = [ 'user_id'
        , 'operation_name'
        , 'table' // table that do operation on
        , 'table_id'
        , 'old_data' // data before update
    ];
    protected $hidden = [];


    protected $casts=[
        'old_data'=>'array'
    ];
}
