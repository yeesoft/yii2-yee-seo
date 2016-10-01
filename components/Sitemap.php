<?php

namespace yeesoft\seo\components;

use Yii;
use XMLWriter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

class Sitemap extends \yii\base\Component
{

    const FREQUENCY_ALWAYS = 'always';
    const FREQUENCY_HOURLY = 'hourly';
    const FREQUENCY_DAILY = 'daily';
    const FREQUENCY_WEEKLY = 'weekly';
    const FREQUENCY_MONTHLY = 'monthly';
    const FREQUENCY_YEARLY = 'yearly';
    const FREQUENCY_NEVER = 'never';

    /** @var int Cache expiration time */
    public $cacheExpire = 86400;

    /** @var string Sitemap cache key */
    public $cacheKey = 'sitemap';

    /** @var string Default change frequency */
    public $defaultChangeFrequency = self::FREQUENCY_WEEKLY;

    /** @var string Default priority */
    public $defaultPriority = '0.8';

    /** @var array List of links for sitemap */
    public $links = [];

    /** @var array List of models for sitemap */
    public $models = [];

    /** @var array Sitemap schemas */
    public $schemas = [
        'xmlns' => 'http://www.sitemaps.org/schemas/sitemap/0.9',
        'xmlns:image' => 'http://www.google.com/schemas/sitemap-image/1.1',
        'xmlns:news' => 'http://www.google.com/schemas/sitemap-news/0.9',
    ];

    /**
     * Render sitemap content.
     * 
     * @return string
     */
    public function render()
    {
        if ($result = Yii::$app->cache->get($this->cacheKey)) {
            return $result;
        }

        $links = $this->generateLinks();

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElement('urlset');

        foreach ($this->schemas as $attr => $schemaUrl) {
            $xml->writeAttribute($attr, $schemaUrl);
        }

        foreach ($links as $link) {
            $xml->startElement('url');
            foreach ($link as $key => $value) {
                $xml->writeElement($key, $value);
            }
            $xml->endElement();
        }

        $xml->endElement();
        $xml->endElement();
        $result = $xml->outputMemory();

        Yii::$app->cache->set($this->cacheKey, $result, $this->cacheExpire);

        return $result;
    }

    /**
     * Generate array of links from `$links` and `$models` properties.
     *
     * @access protected
     * @return array
     */
    protected function generateLinks()
    {
        $result = [];
        $languages = array_keys(Yii::$app->yee->displayLanguages);
        $isMultilingual = Yii::$app->yee->isMultilingual;

        foreach ($this->links as $link) {
            if (isset($link['lastmod'])) {
                $link['lastmod'] = self::dateToW3C($link['lastmod']);
            }

            if (!isset($link['changefreq'])) {
                $link['changefreq'] = $this->defaultChangeFrequency;
            }

            if (!isset($link['priority'])) {
                $link['priority'] = $this->defaultPriority;
            }

            foreach ($languages as $language) {
                $newLink = $link;
                $newLink['loc'] = ($isMultilingual) ? Url::to(ArrayHelper::merge($link['loc'], ['language' => $language]), true) : Url::to($link['loc'], true);
                $result[] = $newLink;
            }
        }

        foreach ($this->models as $model) {

            $items = $model['items']();
            foreach ($items as $item) {

                if (!isset($link['lastmod'])) {
                    $link['lastmod'] = self::dateToW3C($model['lastmod']($item));
                }

                $link['changefreq'] = (isset($model['changefreq'])) ? $model['changefreq'] : $this->defaultChangeFrequency;
                $link['priority'] = (isset($model['priority'])) ? $model['priority'] : $this->defaultPriority;

                foreach ($languages as $language) {
                    $loc = $model['loc']($item);
                    $link['loc'] = ($isMultilingual) ? Url::to(ArrayHelper::merge($loc, ['language' => $language]), true) : Url::to($loc, true);
                    $result[] = $link;
                }
            }
        }

        return $result;
    }

    /**
     * Convert date to W3C format
     *
     * @param mixed $date
     * @return string
     */
    public static function dateToW3C($date)
    {
        if (is_int($date)) {
            return date(DATE_W3C, $date);
        } else {
            return date(DATE_W3C, strtotime($date));
        }
    }

}
