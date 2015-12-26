<?php

use yii\db\Migration;

class m151226_233401_add_seo_permissions extends Migration
{

    public function up()
    {
        $this->insert('auth_item_group', ['code' => 'seoManagement', 'name' => 'SEO Management', 'created_at' => '1440180000', 'updated_at' => '1440180000']);

        $this->insert('auth_item', ['name' => '/admin/seo/*', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/seo/default/*', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/seo/default/bulk-activate', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/seo/default/bulk-deactivate', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/seo/default/bulk-delete', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/seo/default/create', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/seo/default/delete', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/seo/default/grid-page-size', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/seo/default/grid-sort', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/seo/default/index', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/seo/default/toggle-attribute', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/seo/default/update', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/seo/default/view', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);

        $this->insert('auth_item', ['name' => 'fullSeoAccess', 'type' => '2', 'description' => 'Manage other users\' SEO records', 'group_code' => 'seoManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'createSeo', 'type' => '2', 'description' => 'Create SEO records', 'group_code' => 'seoManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'deleteSeo', 'type' => '2', 'description' => 'Delete SEO records', 'group_code' => 'seoManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'editSeo', 'type' => '2', 'description' => 'Edit SEO records', 'group_code' => 'seoManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'viewSeo', 'type' => '2', 'description' => 'View SEO records', 'group_code' => 'seoManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);

        $this->insert('auth_item_child', ['parent' => 'editSeo', 'child' => '/admin/seo/default/bulk-activate']);
        $this->insert('auth_item_child', ['parent' => 'editSeo', 'child' => '/admin/seo/default/bulk-deactivate']);
        $this->insert('auth_item_child', ['parent' => 'deleteSeo', 'child' => '/admin/seo/default/bulk-delete']);
        $this->insert('auth_item_child', ['parent' => 'createSeo', 'child' => '/admin/seo/default/create']);
        $this->insert('auth_item_child', ['parent' => 'deleteSeo', 'child' => '/admin/seo/default/delete']);
        $this->insert('auth_item_child', ['parent' => 'viewSeo', 'child' => '/admin/seo/default/grid-page-size']);
        $this->insert('auth_item_child', ['parent' => 'viewSeo', 'child' => '/admin/seo/default/grid-sort']);
        $this->insert('auth_item_child', ['parent' => 'viewSeo', 'child' => '/admin/seo/default/index']);
        $this->insert('auth_item_child', ['parent' => 'editSeo', 'child' => '/admin/seo/default/toggle-attribute']);
        $this->insert('auth_item_child', ['parent' => 'editSeo', 'child' => '/admin/seo/default/update']);
        $this->insert('auth_item_child', ['parent' => 'viewSeo', 'child' => '/admin/seo/default/view']);

        $this->insert('auth_item_child', ['parent' => 'createSeo', 'child' => 'viewSeo']);
        $this->insert('auth_item_child', ['parent' => 'deleteSeo', 'child' => 'viewSeo']);
        $this->insert('auth_item_child', ['parent' => 'editSeo', 'child' => 'viewSeo']);

        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'createSeo']);
        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'fullSeoAccess']);
        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'deleteSeo']);
        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'editSeo']);
        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'viewSeo']);
    }

    public function down()
    {
        $this->delete('auth_item_child', ['parent' => 'administrator', 'child' => 'createSeo']);
        $this->delete('auth_item_child', ['parent' => 'administrator', 'child' => 'fullSeoAccess']);
        $this->delete('auth_item_child', ['parent' => 'administrator', 'child' => 'deleteSeo']);
        $this->delete('auth_item_child', ['parent' => 'administrator', 'child' => 'editSeo']);
        $this->delete('auth_item_child', ['parent' => 'administrator', 'child' => 'viewSeo']);

        $this->delete('auth_item_child', ['parent' => 'createSeo', 'child' => 'viewSeo']);
        $this->delete('auth_item_child', ['parent' => 'deleteSeo', 'child' => 'viewSeo']);
        $this->delete('auth_item_child', ['parent' => 'editSeo', 'child' => 'viewSeo']);

        $this->delete('auth_item_child', ['parent' => 'editSeo', 'child' => '/admin/seo/default/bulk-activate']);
        $this->delete('auth_item_child', ['parent' => 'editSeo', 'child' => '/admin/seo/default/bulk-deactivate']);
        $this->delete('auth_item_child', ['parent' => 'deleteSeo', 'child' => '/admin/seo/default/bulk-delete']);
        $this->delete('auth_item_child', ['parent' => 'createSeo', 'child' => '/admin/seo/default/create']);
        $this->delete('auth_item_child', ['parent' => 'deleteSeo', 'child' => '/admin/seo/default/delete']);
        $this->delete('auth_item_child', ['parent' => 'viewSeo', 'child' => '/admin/seo/default/grid-page-size']);
        $this->delete('auth_item_child', ['parent' => 'viewSeo', 'child' => '/admin/seo/default/grid-sort']);
        $this->delete('auth_item_child', ['parent' => 'viewSeo', 'child' => '/admin/seo/default/index']);
        $this->delete('auth_item_child', ['parent' => 'editSeo', 'child' => '/admin/seo/default/toggle-attribute']);
        $this->delete('auth_item_child', ['parent' => 'editSeo', 'child' => '/admin/seo/default/update']);
        $this->delete('auth_item_child', ['parent' => 'viewSeo', 'child' => '/admin/seo/default/view']);

        $this->delete('auth_item', ['name' => '/admin/seo/*']);
        $this->delete('auth_item', ['name' => '/admin/seo/default/*']);
        $this->delete('auth_item', ['name' => '/admin/seo/default/bulk-activate']);
        $this->delete('auth_item', ['name' => '/admin/seo/default/bulk-deactivate']);
        $this->delete('auth_item', ['name' => '/admin/seo/default/bulk-delete']);
        $this->delete('auth_item', ['name' => '/admin/seo/default/create']);
        $this->delete('auth_item', ['name' => '/admin/seo/default/delete']);
        $this->delete('auth_item', ['name' => '/admin/seo/default/grid-page-size']);
        $this->delete('auth_item', ['name' => '/admin/seo/default/grid-sort']);
        $this->delete('auth_item', ['name' => '/admin/seo/default/index']);
        $this->delete('auth_item', ['name' => '/admin/seo/default/toggle-attribute']);
        $this->delete('auth_item', ['name' => '/admin/seo/default/update']);
        $this->delete('auth_item', ['name' => '/admin/seo/default/view']);

        $this->delete('auth_item', ['name' => 'fullSeoAccess']);
        $this->delete('auth_item', ['name' => 'createSeo']);
        $this->delete('auth_item', ['name' => 'deleteSeo']);
        $this->delete('auth_item', ['name' => 'editSeo']);
        $this->delete('auth_item', ['name' => 'viewSeo']);

        $this->delete('auth_item_group', ['code' => 'seoManagement']);
    }
}