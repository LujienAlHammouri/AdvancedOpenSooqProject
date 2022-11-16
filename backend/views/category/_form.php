<?php

use yii\helpers\Html;
use common\models\Category;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var Category $model */
/** @var yii\widgets\ActiveForm $form */

$categories= Category::find()->where(['parent_id' => null])->all();
$clistData=ArrayHelper::map($categories,'id','name_en');

?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->dropdownList($clistData,
        ['prompt'=>'Select Category']
    )?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true])?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>