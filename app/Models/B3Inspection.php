<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class B3Inspection extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Relasi ke tabel detail
    public function items(): HasMany
    {
        return $this->hasMany(B3InspectionItem::class);
    }
}
