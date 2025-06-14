<?php

namespace App\Models;

use CodeIgniter\Model;

class Detalle_Venta_Model extends Model
{
    protected $table      = 'detalle_venta';
    protected $primaryKey = 'id_detalle_venta';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_venta', 'id_videojuego', 'detalle_cantidad', 'detalle_precio'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;


}