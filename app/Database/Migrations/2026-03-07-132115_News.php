<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class News extends Migration
{
    public function up()
    {
        // --- Tabela de Categorias ---
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'             => ['type' => 'VARCHAR', 'constraint' => 100],
            'slug'             => ['type' => 'VARCHAR', 'constraint' => 120],
            'meta_description' => ['type' => 'VARCHAR', 'constraint' => 160, 'null' => true],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('news_categories');

        $categories = [
            ['name' => 'Direito Civil',
            'slug' => 'direito-civil',
            'meta_description' => 'Direito Civil'],
            ['name' => 'Direito Administrativo',
            'slug' => 'direito-administrativo',
            'meta_description' => 'Direito Administrativo'],
            ['name' => 'Contratos',
            'slug' => 'contratos',
            'meta_description' => 'Contratos'],
            ['name' => 'Família e Sucessões',
            'slug' => 'familia-e-sucessoes',
            'meta_description' => 'Família e Sucessões'],
            ['name' => 'Advocacia Colaborativa',
            'slug' => 'advocacia-colaborativa',
            'meta_description' => 'Advocacia Colaborativa'],
            ['name' => 'Outro',
            'slug' => 'outro',
            'meta_description' => 'Outro']
        ];
        $this->db->table('news_categories')->insertBatch($categories);

        // --- Tabela de Notícias ---
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'category_id'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'author_id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'title'            => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug'             => ['type' => 'VARCHAR', 'constraint' => 255],
            'summary'          => ['type' => 'TEXT', 'null' => true],
            'content'          => ['type' => 'LONGTEXT'],
            'featured_image'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'meta_title'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'meta_description' => ['type' => 'VARCHAR', 'constraint' => 160, 'null' => true],
            'status'           => ['type' => 'ENUM', 'constraint' => ['draft', 'published'], 'default' => 'draft'],
            'published_at'     => ['type' => 'DATETIME', 'null' => true],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');

        // Índice composto para listagem por categoria (filtrando publicadas e ordenando por data)
        $this->forge->addKey(['category_id', 'status', 'published_at']);

        // Índice composto para listagem geral por status + data (ex: página inicial)
        $this->forge->addKey(['status', 'published_at']);

        // Índice para autor (listagem de notícias por usuário)
        $this->forge->addKey('author_id');

        // Relacionamento com Categorias
        $this->forge->addForeignKey('category_id', 'news_categories', 'id', 'CASCADE', 'RESTRICT');

        // Relacionamento com a tabela de usuários do Shield
        $this->forge->addForeignKey('author_id', 'users', 'id', 'CASCADE', 'RESTRICT');

        $this->forge->createTable('news');

        // FULLTEXT para busca por trechos em título, resumo e conteúdo
        // Criado via query direta pois o Forge não suporta FULLTEXT nativamente
        $this->db->query('ALTER TABLE `news` ADD FULLTEXT INDEX `ft_news_search` (`title`, `summary`, `content`)');
    }

    public function down()
    {
        $this->forge->dropTable('news');
        $this->forge->dropTable('news_categories');
    }
}