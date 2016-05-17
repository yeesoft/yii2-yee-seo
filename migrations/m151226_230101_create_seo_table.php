<?php

use yii\db\Migration;

class m151226_230101_create_seo_table extends Migration
{
    const SEO_TABLE = '{{%seo}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(self::SEO_TABLE, [
            'id' => $this->primaryKey(),
            'url' => $this->string(255)->notNull()->unique(),
            'title' => $this->string(255)->notNull()->defaultValue(''),
            'author' => $this->string(127)->notNull()->defaultValue(''),
            'keywords' => $this->text(),
            'description' => $this->text(),
            'index' => $this->smallInteger()->notNull()->defaultValue(1),
            'follow' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('seo_created_by', self::SEO_TABLE, 'created_by');
        $this->createIndex('seo_url', self::SEO_TABLE, 'url', true);
        $this->createIndex('seo_author', self::SEO_TABLE, 'created_by');
        $this->addForeignKey('fk_seo_created_by', self::SEO_TABLE, 'created_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_seo_updated_by', self::SEO_TABLE, 'updated_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE');

    }

    public function down()
    {
        $this->dropForeignKey('fk_seo_created_by', self::SEO_TABLE);
        $this->dropForeignKey('fk_seo_updated_by', self::SEO_TABLE);
        $this->dropTable(self::SEO_TABLE);
    }
}
