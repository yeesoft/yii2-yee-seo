<?php

namespace yeesoft\seo\components;

use Yii;
use yii\base\Behavior;
use yii\web\View;
use yii\helpers\Html;

/**
 * Seo View Behavior
 *
 * @package yeesoft\seo\components
 */
class SeoViewBehavior extends Behavior
{
    public $preferUrlWithParams = true;

    /**
     * You can use {seo_title}, {view_title}, {site_title}
     * @var type
     */
    public $titleCallback;

    public function init()
    {
        parent::init();

        if (is_null($this->titleCallback)) {
            $this->titleCallback = function($siteName, $viewTitle, $seoTitle) {
                $title = ($seoTitle && !empty($seoTitle)) ? $seoTitle : $viewTitle;
                return implode(' - ', [$siteName, $title]);
            };
        }
    }

    public function renderMetaTags()
    {
        /* @var $view View */
        $view = $this->owner;

        Yii::$app->seo->loadMetaTags($this->preferUrlWithParams);

        $request = Yii::$app->getRequest();
        $path    = $request->getPathInfo();
        $url     = $request->getUrl();

        $titleCallback = $this->titleCallback;
        $siteTitle     = Yii::$app->settings->get('general.title', 'Yee Site');

        if (is_callable($titleCallback)) {
            $title = $titleCallback($siteTitle, $view->title, Yii::$app->seo->title);
        } else {
            $title = $siteTitle;
        }

        echo "<title>{$title}</title>".PHP_EOL;

        $index  = (Yii::$app->seo->index) ? 'index' : 'noindex';
        $follow = (Yii::$app->seo->follow) ? 'follow' : 'nofollow';
        $view->registerMetaTag(['name' => 'robots', 'content' => "$index, $follow"], 'index');

        if (Yii::$app->seo->author) {
            $view->registerMetaTag(['name' => 'author', 'content' => Html::encode(Yii::$app->seo->author)], 'author');
        }

        if (Yii::$app->seo->keywords) {
            $view->registerMetaTag(['name' => 'keywords', 'content' => Html::encode(Yii::$app->seo->keywords)], 'keywords');
        }

        if (Yii::$app->seo->description) {
            $view->registerMetaTag(['name' => 'description', 'content' => Html::encode(Yii::$app->seo->description)], 'description');
        }
    }
}