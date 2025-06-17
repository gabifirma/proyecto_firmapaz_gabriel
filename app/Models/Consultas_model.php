<?php

namespace App\Models;

use CodeIgniter\Model;

class Consultas_Model extends Model
{
    protected $table      = 'mensajes';
    protected $primaryKey = 'id_mensaje';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'nombre_mensaje',
        'apellido_mensaje',
        'correo_mensaje',
        'motivo_mensaje',
        'mensaje_mensaje',
        'leido',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}