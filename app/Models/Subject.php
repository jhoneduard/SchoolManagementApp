<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

    public $timestamps = false;


    protected $fillable = [
        'id', 'name', 'description','number_registered','status','initial_date','end_date'
    ];
}
