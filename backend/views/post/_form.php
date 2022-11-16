<?php

use yii\helpers\Html;
use common\models\Post;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var Post $model */
/** @var yii\widgets\ActiveForm $form */

$categories=\common\models\Category::find()->where(['parent_id' => null])->all();
$plistData=ArrayHelper::map($categories,'id','name_en');

?>

<div class="post-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'category_id')->dropdownList($plistData,
        ['prompt'=>'-Choose a Category-',
            'onchange'=>'
				$.post( "'.Yii::$app->urlManager->createUrl('post/get-sub-categories?id=').'"+$(this).val(), function( data ){
				$( "select#sub_category_id" ).html( data );
				});
			']);?>

    <?= $form->field($model, 'sub_category_id')->dropdownList([],
        ['id' => 'sub_category_id'])?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body')->textarea() ?>

    <?= $form->field($model, 'file_name')->fileInput() ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>