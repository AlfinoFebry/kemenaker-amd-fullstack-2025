<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    /** @use HasFactory<\Database\Factories\TreatmentFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];

    public function checkups()
    {
        return $this->hasMany(Checkup::class);
    }
}
