<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class B3InspectionItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi balik ke tabel induk
    public function inspection(): BelongsTo
    {
        return $this->belongsTo(B3Inspection::class, 'b3_inspection_id');
    }
}
