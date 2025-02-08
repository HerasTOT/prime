<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryFormat extends Model
{
    use HasFactory;
    protected $fillable = [
        'paternalSurname',
        'maternalSurname',
        'email',
        'phone',
        'age',
        'name',
        'birthdate',
        'ssn'
       ];

}
