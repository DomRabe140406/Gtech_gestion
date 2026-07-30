<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProformaDownload extends Model
{
    protected $fillable = ['client_nom', 'user_id', 'downloaded_at'];
}
