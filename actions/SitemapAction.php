<?php

namespace yeesoft\seo\actions;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Description of PageAction
 */
class SitemapAction extends \yii\web\ViewAction
{

    public function run()
    {
        //$this->controller->action = $this;

        $sitemap = Yii::$app->sitemap->render();
        if (empty($sitemap)) {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }

        Yii::$app->getResponse()->format = Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'application/xml');

        return $sitemap;
    }

}
