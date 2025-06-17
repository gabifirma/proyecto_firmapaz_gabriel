<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCamposPersonas extends Migration
{
    public function up()
    {
        $this->forge->addColumn('personas', [
            'dni' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'after' => 'persona_nombre',
                'null' => true,
            ],
            'domicilio' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'after' => 'dni',
                'null' => true,
            ],
            'codigo_postal' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'after' => 'domicilio',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('personas', ['dni', 'domicilio', 'codigo_postal']);
    }
}
