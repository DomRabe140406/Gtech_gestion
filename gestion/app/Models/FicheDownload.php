<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FicheDownload extends Model
{
    protected $fillable = ['formation_nom', 'user_id', 'downloaded_at'];
}
