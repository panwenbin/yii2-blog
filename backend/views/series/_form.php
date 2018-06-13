<?php

use panwenbin\yii2\simplemde\widgets\SimpleMDE;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Series */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="series-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preface')->widget(SimpleMDE::className(), []) ?>

    <label class="control-label">包含日志
        <a id="moveUp" href="javascript:void();">上移</a>
        <a id="moveDown" href="javascript:void();">下移</a>
    </label>
    <?= Html::dropDownList('', '', explode(',', $model->postTitlesString), ['id' => 'postTitlesSelect', 'class' => 'form-control', 'multiple' => true]); ?>

    <?= $form->field($model, 'postTitlesString')->label(false)->hiddenInput(['id' => 'postTitlesString']) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php \mootensai\components\JsBlock::begin() ?>
    <script>
        function swapOption(option1, option2) {
            var value = option1.attr('value');
            var txt = option1.text();
            option1.attr('value', option2.attr('value'));
            option1.text(option2.text());
            option2.attr('value', value);
            option2.text(txt);
            option2.parent().val(value);
            var options = $('#postTitlesSelect').find('option');
            var titles = Array();
            for (var i = 0; i < options.length; i++) {
                titles[i] = options[i].innerText;
            }
            console.log(titles.join(','));
            $('#postTitlesString').val(titles.join(','));
        }

        $('#moveUp').click(function () {
            var selectedTitle = $('#postTitlesSelect > option:selected');
            var prev = selectedTitle.prev();
            if (prev.length) {
                swapOption(selectedTitle, prev);
            }
            return false;
        });
        $('#moveDown').click(function () {
            var selectedTitle = $('#postTitlesSelect > option:selected');
            var next = selectedTitle.next();
            if (next.length) {
                swapOption(selectedTitle, next);
            }
            return false;
        });
    </script>
    <?php \mootensai\components\JsBlock::end() ?>
</div>
