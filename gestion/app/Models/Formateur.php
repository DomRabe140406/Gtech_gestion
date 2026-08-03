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
    //retour d'une relation eloquent
    public function specialites()
    {
        //un formateur peut avoir plusieur specialute et plusieur specialite peut avoir plusieur formateur 
        //c-a-d relation de plusieur a plusieur 
        return $this->belongsToMany(Specialite::class);
    }

    public function formations()
    {
        //un formateur peut creer plusieur formation
        //c-a-d relation un a plusieur 
        return $this->hasMany(Formation::class);
    }
}
