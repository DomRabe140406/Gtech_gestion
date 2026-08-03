<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FactureDownload extends Model
{
    //ajout des variables modifiable sinon on aura une erreur 
    protected $fillable = [
        'client_nom', 
        'user_id', 
        'downloaded_at', 
        'montant'];
}
