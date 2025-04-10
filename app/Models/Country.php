<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
    ];

    public function entryFormat()
    {
        return $this->hasOne(EntryFormat::class);
    }
}
