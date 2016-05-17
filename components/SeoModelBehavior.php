<?php

namespace yeesoft\seo\components;

use Yii;
use yii\base\Behavior;
use yeesoft\db\ActiveRecord;

/**
 * Seo Model Behavior
 *
 * @package yeesoft\seo\components
 *
 * @property ActiveRecord $owner
 */
class SeoModelBehavior extends Behavior
{
    /**
     * Meta tags configuration.
     *
     * Associative array that contains meta tag settings.
     * Two ways possible: string and callable function;
     *
     * If param is string then we try to get field from model.
     *
     * If param is callable function than we call this function
     * to get value of for this meta tag.
     *
     * Example:
     *
     * ```
     * 'meta' => [
     *     'title' => 'title',
     *     'description' => 'desc',
     *     'author' => function($model){
     *         return $model->author->username;
     *     },
     * ]
     * ```
     *
     * @var array
     */
    public $meta;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'loadMeta',
        ];
    }

    public function attach($owner)
    {
        parent::attach($owner);
    }

    public function init()
    {
        parent::init();

        if (!$this->meta) {
            $this->meta = [
                'title' => 'title',
            ];
        }
    }

    /**
     * Return instance of current behavior
     *
     * @return SeoModelBehavior $this
     */
    public function getSeoBehavior()
    {
        return $this;
    }

    public function loadMeta()
    {
        $isSeoComponentLoaded = Yii::$app->get('seo', false);

        if ($isSeoComponentLoaded) {
            foreach ($this->meta as $key => $meta) {

                $value = null;

                if (is_string($meta)) {
                    $value = $this->owner->{$meta};
                } elseif (is_callable($meta)) {
                    $value = $meta($this->owner);
                }

                if ($value) {
                    Yii::$app->seo->{$key} = $value;
                }
            }
        }
    }
}