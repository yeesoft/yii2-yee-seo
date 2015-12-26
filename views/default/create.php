<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yeesoft\seo\models\Seo */

$this->title = Yii::t('yee/seo', 'Create SEO Record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yee/seo', 'SEO'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-create">
    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>
    <?= $this->render('_form', compact('model')) ?>
</div>
