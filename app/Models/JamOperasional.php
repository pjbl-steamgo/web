<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class JamOperasional extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'jam_operasionals';

    protected $fillable = [
        'jam', 
        'is_active'
    ];
}