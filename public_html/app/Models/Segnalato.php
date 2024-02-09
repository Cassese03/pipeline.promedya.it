<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Segnalato extends Model
{
    use HasFactory;


    /**
     * The primary key associated with the table.
     *
     * @var string
     * @property string $descrizione
     */
    protected $primaryKey = 'id';
    protected $fillable = ['descrizione'];

    protected $table = 'segnalato';

    function descrizione() {
        return $this->descrizione;
    }
}
