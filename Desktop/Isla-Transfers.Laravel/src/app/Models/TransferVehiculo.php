php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferVehiculo extends Model
{
    use HasFactory;

    protected $table = 'transfer_vehiculo';
    protected $fillable = [
        'Descripción',
        'email_conductor',
        'password',
    ];
}