<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInvoicesTable extends Migration
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
            'transaction_date'   => [
                'type'           => 'DATE',
            ],
            'total'       => [
                'type'           => 'INT',
                'constraint'     => '11',
                'default'        => 0,
            ],
            'discount'       => [
                'type'           => 'INT',
                'constraint'     => '11',
                'default'        => 0,
            ],
            'grandtotal'       => [
                'type'           => 'INT',
                'constraint'     => '11',
                'default'        => 0,
            ],
            'pdf_filepath' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'note' => [
                'type' => 'TEXT',
                'null' => true,
                'default' => null,
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
        $this->forge->createTable('invoices');
    }

    public function down()
    {
        $this->forge->dropTable('invoices');
    }
}
