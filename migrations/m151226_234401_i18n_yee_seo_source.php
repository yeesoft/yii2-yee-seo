<?php

use yeesoft\i18n\SourceMessagesMigration;

class m151226_234401_i18n_yee_seo_source extends SourceMessagesMigration
{

    public function getCategory()
    {
        return 'yee/seo';
    }

    public function getMessages()
    {
        return [
            'SEO' => 1,
            'Search Engine Optimization' => 1,
            'Create SEO Record' => 1,
            'Update SEO Record' => 1,
        ];
    }
}