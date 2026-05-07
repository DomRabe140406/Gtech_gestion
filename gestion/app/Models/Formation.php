<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
     protected $fillable = [
        'nom_formation',
        'date_debut',
        'nb_jours',
        'nb_participant',
        'nom_formateur',
        'prenom_formateur'
    ];
}
