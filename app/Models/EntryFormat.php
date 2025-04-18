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
        
        'birthdate',
        'ssn',
        'country_id'
    ];

    public function experience()
    {
        return $this->hasOne(Experience::class, 'entry_format_id');
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

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class)
            ->withPivot('language_level_id')
            ->withTimestamps();
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
    
}
