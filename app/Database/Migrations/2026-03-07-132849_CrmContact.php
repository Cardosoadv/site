<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrmContact extends Migration
{
    public function up()
    {
        // --- Tabela de Áreas de Interesse ---
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'area_interesse'   => ['type' => 'ENUM', 'constraint' => ['Direito Civil', 'Direito Administrativo', 'Contratos', 'Família e Sucessões', 'Advocacia Colaborativa', 'Outro'], 'default' => 'Direito Civil'],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('crm_areas');

        $areas = [
            ['area_interesse' => 'Direito Civil'],
            ['area_interesse' => 'Direito Administrativo'],
            ['area_interesse' => 'Contratos'],
            ['area_interesse' => 'Família e Sucessões'],
            ['area_interesse' => 'Advocacia Colaborativa'],
            ['area_interesse' => 'Outro']
        ];
        $this->db->table('crm_areas')->insertBatch($areas);

        // --- Tabela de Contatos ---
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'             => ['type' => 'VARCHAR', 'constraint' => 100],
            'email'            => ['type' => 'VARCHAR', 'constraint' => 100],
            'phone'            => ['type' => 'VARCHAR', 'constraint' => 20],
            'message'          => ['type' => 'TEXT'],
            'area_interesse'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'status'           => ['type' => 'ENUM', 'constraint' => ['new', 'contacted', 'qualified', 'converted', 'lost'], 'default' => 'new'],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('area_interesse', 'crm_areas', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('crm_contacts');
    }

    public function down()
    {
        $this->forge->dropTable('crm_contacts');
        $this->forge->dropTable('crm_areas');
    }
}
