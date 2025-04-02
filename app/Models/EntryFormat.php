<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryFormat extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'secondName',
        'lastName',
        'email',
        'phone',
        'age',
        'birthdate',
        'ssn'
       ];

}
