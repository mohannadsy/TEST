<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trash extends Model
{
    use HasFactory;


    protected $table = 'trashes';
    protected $fillable = ['user_id', 'table', 'table_id'];
    protected $hidden = [];
}
