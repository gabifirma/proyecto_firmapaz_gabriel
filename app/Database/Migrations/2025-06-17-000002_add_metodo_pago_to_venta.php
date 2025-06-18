<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMetodoPagoToVenta extends Migration
{
    public function up()
    {
        $this->forge->addColumn('venta', [
            'metodo_pago' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'after' => 'total_venta',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('venta', 'metodo_pago');
    }
}
