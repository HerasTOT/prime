<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description'
    ];

    public function skilledPeople()
    {
        return $this->belongsToMany(EntryFormat::class, 'entry_format_skills');
    }

    public function desiredBy()
    {
        return $this->belongsToMany(EntryFormat::class, 'entry_format_desired_jobs');
    }
}
