<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'facturas';
    protected $fillable = ['numero', 'detalles', 'valor', 'archivo', 'idcliente', 'idforma', 'idestado'];
    
    public function scopeBuscador($query, $numero){
        return $query->where('numero','LIKE','%'.$numero.'%');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idcliente');
    }

}
