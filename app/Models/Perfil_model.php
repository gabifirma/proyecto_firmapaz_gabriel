<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id_perfil';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['perfil_descripcion'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

}