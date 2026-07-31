<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
     protected $fillable = [
        'nom_formation',
        'date_debut',
        'nb_jours',
        'statut',
        'nb_participant',
        'formateur_id',
        'specialite_id'
    ];

    public function formateur()
    {
        return $this->belongsTo(Formateur::class);
    }

    public function specialite()
    {
        return $this->belongsTo(Specialite::class);
    }
}
