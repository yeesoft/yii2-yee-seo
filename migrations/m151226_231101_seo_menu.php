<?php

use yii\db\Migration;

class m151226_231101_seo_menu extends Migration
{

    public function up()
    {
        $this->insert('{{%menu_link}}', ['id' => 'admin-menu-seo', 'menu_id' => 'admin-menu', 'link' => '/seo/default/index', 'image' => 'line-chart', 'created_by' => 1, 'order' => 19]);
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'admin-menu-seo', 'label' => 'SEO', 'language' => 'en-US']);
    }

    public function down()
    {
        $this->delete('{{%menu_link}}', ['like', 'id', 'admin-menu-seo']);
    }
}