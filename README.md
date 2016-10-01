# yii2-yee-seo

##Yee CMS - Search Engine Optimization Module

####Backend module for managing translations 

This module is part of Yee CMS (based on Yii2 Framework).

SEO module lets you easily create and manage search engine optimization records on your site. The module also helps you easily generate sitemap.xml file.

Installation
------------

- Either run

```
composer require --prefer-dist yeesoft/yii2-yee-seo "*"
```

or add

```
"yeesoft/yii2-yee-seo": "*"
```

to the require section of your `composer.json` file.

- Run migrations

```php
yii migrate --migrationPath=@vendor/yeesoft/yii2-yee-seo/migrations/
```

Configuration
------
- In your backend config file

```php
'modules' => [
	'seo' => [
		'class' => 'yeesoft\page\SeoModule',
	],
],
```

- In your frontend config file

```php
'components' => [
	'seo' => [
		'class' => 'yeesoft\seo\components\Seo',
	],
],
```

Sitemap configuration
------
Note! For multilingual sites links will be generate for all languages.

- In your frontend config file

```php
'components' => [
	'sitemap' => [
		'class' => 'yeesoft\seo\components\Sitemap',
		'links' => [//list of links
        		['loc' => ['/site/index'], 'priority' => '1'],
        		['loc' => ['/blog/index']],
    		],
    		'models' => [//list of links generated using models
        		[
            			'items' => function () {
                			return yeesoft\post\models\Post::find()->where(['status' => 1])->all();
		    		},
            			'loc' => function ($model) {
                			return ['/site/index', 'slug' => $model->slug];
            			},
            			'lastmod' => function ($model) {
                			return $model->updated_at;
            			},
        		],
		],
	],
],
```

- Frontend routes for sitemap

```php
'components' => [
	'urlManager' => [
		...
		'rules' => [
			...
        		'sitemap.xml' => 'sitemap/index',
    		],
	],
],
```
