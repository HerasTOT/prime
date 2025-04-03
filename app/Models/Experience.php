<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $fillable = [
        'position',
        'company',
        'supervisor',
        'address',
        'company_phone',
        'salary',
        'start_date',
        'end_date',
        'termination_reason',
        'entry_format_id'
    ];

    public function entryFormat()
    {
        return $this->belongsTo(EntryFormat::class);
    }
}
