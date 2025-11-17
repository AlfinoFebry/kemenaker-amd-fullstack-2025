<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkup extends Model
{
    /** @use HasFactory<\Database\Factories\CheckupFactory> */
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'treatment_id',
        'checkup_date',
        'notes',
    ];

    protected $casts = [
        'checkup_date' => 'date',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }
}
