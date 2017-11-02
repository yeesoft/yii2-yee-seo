<?php

use yeesoft\db\PermissionsMigration;

class m151226_233401_seo_permissions extends PermissionsMigration
{

    public function safeUp()
    {
        $this->addPermissionsGroup('seo-management', 'SEO Management');

        parent::safeUp();
    }

    public function safeDown()
    {
        parent::safeDown();
        $this->deletePermissionsGroup('seo-management');
    }

    public function getPermissions()
    {
        return [
            'seo-management' => [
                'view-seo' => [
                    'title' => 'View SEO Records',
                    'roles' => [self::ROLE_ADMIN],
                    'routes' => [
                        ['bundle' => self::ADMIN_BUNDLE, 'controller' => 'seo/default', 'action' => 'index'],
                        ['bundle' => self::ADMIN_BUNDLE, 'controller' => 'seo/default', 'action' => 'grid-sort'],
                        ['bundle' => self::ADMIN_BUNDLE, 'controller' => 'seo/default', 'action' => 'grid-page-size'],
                    ],
                ],
                'update-seo' => [
                    'title' => 'Update SEO Records',
                    'child' => ['view-seo'],
                    'roles' => [self::ROLE_ADMIN],
                    'routes' => [
                        ['bundle' => self::ADMIN_BUNDLE, 'controller' => 'seo/default', 'action' => 'update'],
                    ],
                ],
                'create-seo' => [
                    'title' => 'Create SEO Records',
                    'child' => ['view-seo'],
                    'roles' => [self::ROLE_ADMIN],
                    'routes' => [
                        ['bundle' => self::ADMIN_BUNDLE, 'controller' => 'seo/default', 'action' => 'create'],
                    ],
                ],
                'delete-seo' => [
                    'title' => 'Delete SEO Records',
                    'child' => ['view-seo'],
                    'roles' => [self::ROLE_ADMIN],
                    'routes' => [
                        ['bundle' => self::ADMIN_BUNDLE, 'controller' => 'seo/default', 'action' => 'delete'],
                        ['bundle' => self::ADMIN_BUNDLE, 'controller' => 'seo/default', 'action' => 'bulk-delete'],
                    ],
                ],
            ],
        ];
    }

}
