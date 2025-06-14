<?php

namespace App\Models;

use CodeIgniter\Model;

class Personas_Model extends Model
{
    protected $table      = 'personas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['persona_apellido', 'persona_nombre', 'persona_pais', 'persona_mail', 'persona_password', 'id_perfil', 'persona_estado'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}