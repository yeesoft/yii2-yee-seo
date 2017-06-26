<?php

/* @var $this yii\web\View */
/* @var $model yeesoft\seo\models\Seo */

$this->title = Yii::t('yee/seo', 'Update SEO Record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yee/seo', 'SEO'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', compact('model')) ?>