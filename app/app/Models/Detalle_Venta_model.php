<?php

namespace App\Models;

use CodeIgniter\Model;

class Detalle_Venta_Model extends Model
{
    protected $table      = 'detalle_venta';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_venta', 'id_videojuego', 'detalle_cantidad', 'detalle_precio'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    public function obtenerVideojuegosMasPopulares($limite = 3){
        return $this->select('videojuegos.id_videojuego, videojuegos.titulo_videojuego, videojuegos.precio_videojuego, videojuegos.imagen_videojuego, COUNT(detalle_venta.id_videojuego) as cantidad_vendida')
                ->join('videojuegos', 'videojuegos.id_videojuego = detalle_venta.id_videojuego')
                ->groupBy('detalle_venta.id_videojuego')
                ->orderBy('cantidad_vendida', 'DESC')
                ->limit($limite)
                ->findAll();
    }
}