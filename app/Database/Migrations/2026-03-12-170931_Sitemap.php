<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sitemap extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'last_modified' => [
                'type' => 'DATETIME',
            ],
            'priority' => [
                'type' => 'DECIMAL',
                'constraint' => '3,1',
            ],
            'changefreq' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('sitemap');
    }

    public function down()
    {
        $this->forge->dropTable('sitemap');
    }
}
