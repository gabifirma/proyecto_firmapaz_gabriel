<?php

namespace App\Models;

use CodeIgniter\Model;

class Videojuegos_Model extends Model
{
    protected $table      = 'videojuegos';
    protected $primaryKey = 'id_videojuego';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['titulo_videojuego', 'descripcion_videojuego', 'desarrollador_videojuego', 'distribuidor_videojuego','precio_videojuego', 'imagen_videojuego','categoria_id'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = '';
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
}