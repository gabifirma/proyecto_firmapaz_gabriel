<?php

namespace App\Models;

use CodeIgniter\Model;

class Ventas_Model extends Model
{
    protected $table      = 'venta';
    protected $primaryKey = 'id_venta';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_persona', 'fecha_venta', 'total_venta', 'metodo_pago'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;


}