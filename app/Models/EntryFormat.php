<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryFormat extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'middle_name',
        'last_name',
        'mother_last_name',
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
