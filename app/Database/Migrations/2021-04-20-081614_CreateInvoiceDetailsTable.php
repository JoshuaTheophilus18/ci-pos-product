<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInvoiceDetailsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => '11',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'invoice_id'   => [
                'type'           => 'INT',
                'constraint'     => '11',
                'unsigned'       => true,
            ],
            'product_name'   => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'qty'       => [
                'type'           => 'INT',
                'constraint'     => '11',
            ],
            'price'       => [
                'type'           => 'INT',
                'constraint'     => '11',
            ],
            'discount'       => [
                'type'           => 'INT',
                'constraint'     => '11',
            ],
            'subtotal'       => [
                'type'           => 'INT',
                'constraint'     => '11',
            ],
            'created_at' => [
                'type'  => 'DATETIME',
                'null'  => true,
            ],
            'updated_at' => [
                'type'  => 'DATETIME',
                'null'  => true,
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('invoice_id', 'invoices', 'id');
        $this->forge->createTable('invoice_details');
    }

    public function down()
    {
        $this->forge->dropTable('invoice_details');
    }
}
