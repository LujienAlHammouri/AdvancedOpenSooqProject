<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use common\models\Favourite;
use yii\grid\ActionColumn;

/** @var yii\web\View $this */
/** @var \common\models\FavouriteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Favourites');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="favourite-index">

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1 class="m-0 font-weight-bold text-primary">Favourites</h1>
            </div>
            <div class="card-body">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'post_id',
            'category.name_en:text:Category',
            'subCategory.name_en:text:Sub Category',
            'post.body',
            'post.mobile',
            [
                    'attribute' => 'post.image',
                'format' => [
                        'image',
                    [
                        'width' => 150,
                        'height' => 100,
                    ]
                ]
            ],
            'post.created_at',
            'post.updated_at',
            'post.created_by',
            'post.updated_by',

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Favourite $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>