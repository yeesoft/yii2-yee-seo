<?php

use yii\db\Migration;

class m151226_233401_add_seo_permissions extends Migration
{

    public function beforeUp()
    {
        $this->addPermissionsGroup('seoManagement', 'SEO Management');
    }

    public function afterDown()
    {
        $this->deletePermissionsGroup('seoManagement');
    }

    public function getPermissions()
    {
        return [
            'seoManagement' => [
                'links' => [
                    '/admin/seo/*',
                    '/admin/seo/default/*',
                ],
                'viewSeo' => [
                    'title' => 'View SEO Records',
                    'links' => [
                        '/admin/seo/default/index',
                        '/admin/seo/default/grid-sort',
                        '/admin/seo/default/grid-page-size',
                    ],
                    'roles' => [
                        self::ROLE_ADMIN,
                    ],
                ],
                'editSeo' => [
                    'title' => 'Edit SEO Records',
                    'links' => [
                        '/admin/seo/default/update',
                    ],
                    'roles' => [
                        self::ROLE_ADMIN,
                    ],
                    'childs' => [
                        'viewSeo',
                    ],
                ],
                'createSeo' => [
                    'title' => 'Create SEO Records',
                    'links' => [
                        '/admin/seo/default/create',
                    ],
                    'roles' => [
                        self::ROLE_ADMIN,
                    ],
                    'childs' => [
                        'viewSeo',
                    ],
                ],
                'deleteSeo' => [
                    'title' => 'Delete SEO Records',
                    'links' => [
                        '/admin/seo/default/delete',
                        '/admin/seo/default/bulk-delete',
                    ],
                    'roles' => [
                        self::ROLE_ADMIN,
                    ],
                    'childs' => [
                        'viewSeo',
                    ],
                ],
                'fullSeoAccess' => [
                    'title' => 'Full SEO Records Access',
                    'roles' => [
                        self::ROLE_ADMIN,
                    ],
                ],
            ],
        ];
    }
}