<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Blogger */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blogger-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'index_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_regexp')->textInput(['maxlength' => true])->label('文章地址和标题匹配（命名url、title或者第一项为地址，第二项为标题）') ?>

    <?= $form->field($model, 'title_regexp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content_regexp')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
