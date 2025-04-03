<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryFormat extends Model
{
    use HasFactory;
    protected $fillable = [
        'names',
        'first_surname',
        'second_surname',
        'email',
        'phone',
        'age',
        'birthdate',
        'ssn'
    ];

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function skills()
    {
        return $this->belongsToMany(JobPosition::class, 'entry_format_skills');
    }

    // Puestos que desea desempeñar
    public function desiredJobs()
    {
        return $this->belongsToMany(JobPosition::class, 'entry_format_desired_jobs');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
