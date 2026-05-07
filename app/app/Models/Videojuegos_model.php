<?php

namespace App\Models;

use CodeIgniter\Model;

class Videojuegos_model extends Model
{
    protected $table      = 'videojuegos';
    protected $primaryKey = 'id_videojuego';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['titulo_videojuego', 'descripcion_videojuego', 'desarrollador_videojuego', 'distribuidor_videojuego','precio_videojuego', 'imagen_videojuego', 'id_categoria','estado_videojuego', 'videojuego_stock'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
}