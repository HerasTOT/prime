<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'path',
        'size',
        'mime_type',
        'document_id',
        'fileable_id',
        'fileable_type',
    ];

    // Relación con poliformifica (1 a m)
    public function fileable()
    {
        return $this->morphTo();
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
