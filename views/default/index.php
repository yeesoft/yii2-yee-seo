<?php

use yii\widgets\Pjax;
use yeesoft\helpers\Html;
use yeesoft\grid\GridView;
use yeesoft\seo\models\Seo;

/* @var $this yii\web\View */
/* @var $searchModel yeesoft\seo\models\SeoSearch */
/* @var $dataProvider yeesoft\data\ActiveDataProvider */

$this->title = Yii::t('yee/seo', 'Search Engine Optimization');
$this->params['breadcrumbs'][] = $this->title;

$this->params['description'] = 'YeeCMS 0.2.0';
$this->params['header-content'] = Html::a(Yii::t('yee', 'Add New'), ['create'], ['class' => 'btn btn-sm btn-primary']);
?>

<div class="box box-primary">
    <div class="box-body">
        <?php $pjax = Pjax::begin() ?>
        <?=
        GridView::widget([
            'pjaxId' => $pjax->id,
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'quickFilters' => false,
            'columns' => [
                ['class' => 'yeesoft\grid\CheckboxColumn', 'options' => ['style' => 'width:10px'], 'displayFilter' => false],
                [
                    'attribute' => 'url',
                    'class' => 'yeesoft\grid\columns\TitleActionColumn',
                    'controller' => '/seo/default',
                    'title' => function (Seo $model) {
                        return Html::a($model->url, ['/seo/default/update', 'id' => $model->id], ['data-pjax' => 0]);
                    },
                    'buttonsTemplate' => '{update} {delete}',
                    'filterOptions' => ['colspan' => 2],
                ],
                [
                    'attribute' => 'title',
                    'options' => ['style' => 'width:50%'],
                ],
                //'author',
                //'keywords',
                //'description',
                [
                    'class' => 'yeesoft\grid\columns\StatusColumn',
                    'attribute' => 'index',
                    'options' => ['style' => 'width:30px'],
                ],
                [
                    'class' => 'yeesoft\grid\columns\StatusColumn',
                    'attribute' => 'follow',
                    'options' => ['style' => 'width:30px'],
                ],
            ],
        ]);
        ?>
        <?php Pjax::end() ?>
    </div>
</div>