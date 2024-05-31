<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CF extends Model
{

    protected $table = 'cf';
    protected $connection = 'arca';
    public $timestamps = false;

    use HasFactory;
}
