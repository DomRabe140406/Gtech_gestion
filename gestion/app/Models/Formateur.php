<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Specialite;

class Formateur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_formateur',
        'prenom_formateur',
        'email',
        'telephone',
    ];

    public function specialites()
    {
        return $this->belongsToMany(Specialite::class);
    }

    public function formations()
    {
        return $this->hasMany(Formation::class);
    }
}
