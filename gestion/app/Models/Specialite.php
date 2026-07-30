<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Formateur;

class Specialite extends Model
{
    protected $fillable = [
        'nom_specialite',
    ];

    public function formateurs()
    {
        return $this->belongsToMany(Formateur::class);
    }
}
