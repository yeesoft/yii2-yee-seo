<?php

use yii\db\Migration;

class m151226_230101_create_seo_table extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('seo', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255)->notNull()->unique(),
            'title' => $this->string(255)->notNull()->defaultValue(''),
            'author' => $this->string(127)->notNull()->defaultValue(''),
            'keywords' => $this->text()->defaultValue(''),
            'description' => $this->text()->defaultValue(''),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->defaultValue(NULL),
            'updated_by' => $this->integer()->defaultValue(NULL),
            ], $tableOptions);

        $this->createIndex('seo_created_by', 'seo', 'created_by');
        $this->createIndex('seo_url', 'seo', 'url');
        $this->createIndex('seo_author', 'seo', 'created_by');

        $this->addForeignKey('fk_seo_created_by', 'seo', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
        $this->addForeignKey('fk_seo_updated_by', 'seo', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');

    }

    public function down()
    {
        $this->dropForeignKey('fk_seo_created_by', 'seo');
        $this->dropForeignKey('fk_seo_updated_by', 'seo');
        $this->dropTable('seo');
    }
}