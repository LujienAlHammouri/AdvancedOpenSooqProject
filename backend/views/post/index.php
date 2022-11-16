<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use common\models\Post;
use yii\grid\ActionColumn;
use common\models\PostSearch;

/** @var yii\web\View $this */
/** @var PostSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create Post'), ['create'], [ 'class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm',
            'style' => 'position:relative; left:1085px; top:2px; ',]) ?>
    </p>

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1 class="m-0 font-weight-bold text-primary">Posts</h1>
            </div>
            <div class="card-body">

                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        // 'filterModel' => $searchModel,
                        'tableOptions' => [
                            //'id'=>'dataTable',
                            'class'=>'table table-responsive table-bordered ',
                        ],
                        'pager' => [
                            'firstPageLabel' => 'First',
                            'lastPageLabel'  => 'Last',
                        ],

                        'summary'=>'',
                        'columns' => [
                            // ['class' => 'yii\grid\SerialColumn'],

                            'id',
                            'category.name_en:text:Category',
                            'subCategory.name_en:text:Sub Category',
                            'mobile',
                            'body',
                            //'file_name',
                            [
                                'attribute' => 'file_name',
                                'value' => function ($model) {
                                    $image = 'http://backend.lan/uploads/' . $model->file_name;
                                    return "<img src={$image} width=150 height=100  alt=>";
                                },
                                'format'=>'html'
                            ],
                            'created_at',
                            'updated_at',
                            'created_by',
                            'updated_by',

                            [
                                'class' => ActionColumn::className(),
                                'urlCreator' => function ($action, Post $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model->id]);
                                },
                                'template' => "{view}\n{update}\n{delete}",
                                'headerOptions' => ['class' => 'icon-5'],

                            ],

                        ],
                    ]
                );

                ?>

                <?php Pjax::end(); ?>

            </div>