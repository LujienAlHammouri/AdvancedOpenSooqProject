<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use common\models\Post;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var Post $model */

$this->title = $model->id;
YiiAsset::register($this);
?>
<style>
    .fa-2x{
        font-size: 40px;
    }
</style>
<div class="post-view">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1 class="m-0 font-weight-bold text-primary">Post</h1>
            </div>
            <div class="card-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'mobile',
            'body',
            [
                'attribute' => 'file_name',
                'label'=>'Image',
                'value' => function ($model) {
                    $image = 'http://backend.lan/uploads/' . $model->file_name;
                    return "<img src={$image} width=150 height=100  alt=>";
                },
                'format'=>'html'
            ],
            'created_at',
        ],

    ]);


    if($model->isFavourite()){

     echo Html::a(
        Html::tag('i', null, ['class' => ['fa fa-heart fa-2x']]),
         ['site/favourite', 'id' => $model->id]);
    }
else
{
   echo Html::a(
        Html::tag('i', null, ['class' => ['fa fa-heart-o fa-2x']]),
       ['site/favourite', 'id' => $model->id]); }?>
           </div>
       </div>
    </div>
</div>