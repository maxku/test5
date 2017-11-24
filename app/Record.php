<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{

    protected $fillable = ['user_id', 'number', 'mark', 'color'];

    protected $table = 'records';

    public $timestamps = false;
}
