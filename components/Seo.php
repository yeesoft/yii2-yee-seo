<?php

namespace yeesoft\seo\components;

use Yii;
use yii\base\Component;
use yii\caching\Cache;
use yeesoft\seo\models\Seo as SeoRecords;

class Seo extends Component
{
    /**
     * @var Cache|string the cache object or the application component ID of the cache object.
     * Settings will be cached through this cache object, if it is available.
     *
     * Set this property to null if you do not want to cache the settings.
     */
    public $cache = 'cache';

    /**
     * Used by the cache component.
     *
     * @var string cache key
     */
    public $cacheKey     = 'settings';

    public $fields = ['title', 'author', 'keywords', 'description', 'index', 'follow'];
    
    public $title;
    public $author;
    public $keywords;
    public $description;
    public $index        = true;
    public $follow       = true;
    public $isMetaLoaded = false;

    public function loadMetaTags($preferUrlWithParams = true)
    {
        $request = Yii::$app->getRequest();
        $path    = '/'.$request->getPathInfo();
        $url     = $request->getUrl();

        $preferOrder = ($preferUrlWithParams) ? 'DESC' : 'ASC';

        $seo = SeoRecords::find()
            ->orWhere(['url' => $path])
            ->orWhere(['url' => $url])
            ->orderBy("url $preferOrder")
            ->one();

        if ($seo) {
            foreach ($this->fields as $field) {
                if (isset($seo->{$field})) {
                    $this->{$field} = $seo->{$field};
                }
            }
        }
    }
}