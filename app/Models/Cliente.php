<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $fillable =['nombre','rfc','direccion','telefono','email'];

    public function scopeBuscador($query, $nombre){
        return $query->where('nombre','LIKE','%'.$nombre.'%');
    }

    public function facturas(){
        return $this->hasMany('App\Factura');
    }
}
