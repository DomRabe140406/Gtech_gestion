<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    //ce que laravel autorise a remplir automatiquement
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
        //chaque formation appartient a un formateur
        return $this->belongsTo(Formateur::class);
    }

    public function specialite()
    {
        //chaque formation a une specialite
        return $this->belongsTo(Specialite::class);
    }
}
