<?php

use common\models\Category;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var Category[] $categories */

$this->title = 'My Yii Application';
?>

<div class="row container-top">
    <?php foreach ($categories as $category) : ?>
        <div class="col col-md-3 top">
            <?= Html::a(
                Html::tag('i', null, ['class' => ['fa', $category->icon, 'fa-2x']]) .
                Html::tag('h4', $category->name_en),
                ['site/listing', 'category_id' => $category->id]
            ) ?>
        </div>
    <?php endforeach; ?>
</div>