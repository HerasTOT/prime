<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'native_name'
    ];

    public function entryForms()
    {
        return $this->belongsToMany(EntryFormat::class)
                    ->withPivot('language_level_id')
                    ->withTimestamps();
    }
}
