<?php

namespace yeesoft\seo\controllers;

use yeesoft\controllers\admin\BaseController;

/**
 * Controller implements the CRUD actions for Seo model.
 */
class DefaultController extends BaseController
{
    public $modelClass = 'yeesoft\seo\models\Seo';
    public $modelSearchClass = 'yeesoft\seo\models\search\SeoSearch';

    public $disabledActions = ['view','bulk-activate', 'bulk-deactivate'];

    protected function getRedirectPage($action, $model = null)
    {
        switch ($action) {
            case 'update':
                return ['update', 'id' => $model->id];
                break;
            case 'create':
                return ['update', 'id' => $model->id];
                break;
            default:
                return parent::getRedirectPage($action, $model);
        }
    }
}