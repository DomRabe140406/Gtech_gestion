<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
     protected $fillable = [
        'ref_formation',   
        'nom_formation',
        'date_debut',
        'nb_jours',
        'statut',
        'nb_participant',
        'nom_formateur',
        'prenom_formateur'
    ];
}
