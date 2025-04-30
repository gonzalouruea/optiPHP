<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Viajero extends Model
{
    protected $table = 'transfer_viajero';
    protected $primaryKey = 'id_viajero';

    protected $fillable = [
        'nombre',
        'apellido1',
        'apellido2',
        'direccion',
        'codigoPostal',
        'ciudad',
        'pais'
    ];  //

    /**
     * Get the user that owns the viajero.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
