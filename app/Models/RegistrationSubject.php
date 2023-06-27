<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationSubject extends Model
{
    protected $table = 'registration_subjects';

    public $timestamps = false;


    protected $fillable = [
        'id', 'id_subject', 'id_student','date_registration','status','initial_date','qualification_end'
    ];
}
