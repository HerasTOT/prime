<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'email',
        'company',
        'position',
        'address',
        'supervisor',
        'company_phone',
        'salary',
        'start_date',
        'end_date',
        'termination_reason',
        'entryformat_id'
    ];
}
