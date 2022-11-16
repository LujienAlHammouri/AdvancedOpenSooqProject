<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \common\models\Favourite $model */

$this->title = Yii::t('app', 'Create Favourite');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Favourites'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="favourite-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>