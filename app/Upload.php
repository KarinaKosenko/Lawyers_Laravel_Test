<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Upload - a model for working with files uploads.
 */
class Upload extends Model
{
    protected $guarded = [
        'id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
