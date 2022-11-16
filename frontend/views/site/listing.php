<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use common\models\Post;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var Post[] $posts */

$category = $posts[0]->category;

$this->title = 'Listing';
$sub_category_id = Yii::$app->request->get('sub_category_id');
if (empty($sub_category_id)) {
    $this->params['breadcrumbs'][] = [
        'label' => $category->name_en,
    ];
} else {
    $this->params['breadcrumbs'][] = [
        'label' => $category->name_en,
        'url' => ['site/listing', 'category_id' => $category->id]
    ];

    $sub_categories = ArrayHelper::map($category->categories, 'id', 'name_en');
    $this->params['breadcrumbs'][] = [
        'label' => $sub_categories[$sub_category_id],
    ];
}
?>
<div class="row">
    <div class="col-3">
        <ul class="list-group">
            <?php foreach ($category->categories as $SubCategory) : ?>
                <?= Html::tag('li', Html::a($SubCategory->name_en, ['site/listing', 'category_id' => $posts[0]->category->id, 'sub_category_id' => $SubCategory->id]), ['class' => 'list-group-item']) ?>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-9">

        <?php foreach ($posts as $post) : ?>
        <a href="<?= Url::to(['site/view', 'id' => $post->id])?>">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= $post->mobile ?>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted"></h6>
                    <p class="card-text">
                        <?= $post->body ?>
                    </p>
                </div>
            </div>
        </a>
        <?php endforeach; ?>

    </div>
</div>