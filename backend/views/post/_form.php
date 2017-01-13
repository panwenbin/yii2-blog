<?php

use panwenbin\yii2\simplemde\widgets\SimpleMDE;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map([Yii::$app->getUser()->getIdentity()], 'id', 'username'), ['readonly' => 'readonly'])->label('作者') ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tagNames')->widget(\kartik\select2\Select2::className(), [
        'data' => ArrayHelper::map(\common\models\Tag::find()->asArray()->all(), 'name', 'name'),
        'options' => ['placeholder' => '添加标签', 'multiple' => true],
        'pluginOptions' => [
            'tags' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'content')->widget(SimpleMDE::className(), []) ?>

    <?php if ($model->isNewRecord == false): ?>
        <?= $model->isArchive() ? '<p class="bg-warning">对于存档不建议修改，除非有不得已的原因</p>' : $form->field($model, 'makeOldAsArchive')->checkbox() ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '发布日志' : '更新日志', ['class' => $model->isNewRecord == false ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
