# yii2-yee-seo

##Yee CMS - Search Engine Optimization Module

####Backend module for managing translations 

This module is part of Yee CMS (based on Yii2 Framework).

SEO module lets you easily create and manage search engine optimization records on your site. 

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
'modules'=>[
	'seo' => [
		'class' => 'yeesoft\page\SeoModule',
	],
],
```
