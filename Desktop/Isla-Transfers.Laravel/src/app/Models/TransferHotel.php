php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferHotel extends Model
{
    use HasFactory;

    protected $table = 'transfer_hotel';
    protected $fillable = [
        'id_zona',
        'Comision',
        'Usuario',
        'password',
    ];

    public function zona()
    {
        return $this->belongsTo(TransferZona::class, 'id_zona', 'id_zona');
    }
}