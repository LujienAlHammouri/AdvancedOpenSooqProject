<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use common\models\Post;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var \common\models\Favourite[] $favourites*/

$this->title = 'Favourites';
YiiAsset::register($this);

?>
<style>
    .fa-2x{
        font-size: 40px;
    }
</style>
<div class="favourite-index">

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1 class="m-0 font-weight-bold text-primary">Favourites</h1>
            </div>
            <?php foreach ($favourites as $favourite) : ?>
            <div class="card-body">
                 <?= DetailView::widget([
                 'model' => $favourite,
                 'attributes' => [
                         'post.mobile',
                         'post.body',
                         'post.created_at'
                 ],
                 ]);
                 echo Html::a(
                 Html::tag('i', null, ['class' => ['fa fa-trash fa-2x']]),
                     ['site/delete', 'id' => $favourite->id]);
                 ?>
           </div>
            <?php endforeach; ?>
       </div>
    </div>
</div>