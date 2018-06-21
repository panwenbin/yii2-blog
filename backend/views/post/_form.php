<?php

use panwenbin\yii2\simplemde\widgets\SimpleMDE;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */

$draftId = Yii::$app->request->get('draft_id');
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tagNames')->widget(\kartik\select2\Select2::className(), [
        'data' => ArrayHelper::map(\common\models\Tag::find()->asArray()->all(), 'name', 'name'),
        'options' => ['placeholder' => '添加标签', 'multiple' => true],
        'pluginOptions' => [
            'tags' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'seriesId')->label('系列')->widget(\kartik\select2\Select2::className(), [
        'data' => ArrayHelper::map(\common\models\Series::find()->asArray()->all(), 'id', 'title'),
        'options' => ['placeholder' => '归属系列'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'content')->widget(SimpleMDE::className(), []) ?>

    <p class="hidden draft-note pull-right text-success">草稿已保存 @<span class="time"></span></p>

    <?php if ($model->isNewRecord == false): ?>
        <?= $model->isArchive() ? '<p class="bg-warning">对于存档不建议修改，除非有不得已的原因</p>' : $form->field($model, 'makeOldAsArchive')->checkbox() ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '发布日志' : '更新日志', ['class' => $model->isNewRecord == false ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php \mootensai\components\JsBlock::begin() ?>
<script>
    var draftId = '<?=$draftId?>';

    function draft() {
        var title = $('#post-title').val();
        var content = EditorpostContent.value();
        var oldContent = $('#post-content').val();
        if (content == oldContent) {
            return;
        }
        var tagArr = Array();
        $('.select2 ul li').each(function () {
            tagArr.push($(this).attr('title'));
        })
        var tags = tagArr.join(',');
        $.post('<?=Url::to(['/api/draft/auto'])?>?id=' + draftId, {
            post_id: '<?=$model->id?>',
            title: title,
            content: content,
            tags: tags
        }, function (ret) {
            if (ret.code == 200) {
                draftId = ret.id;
                $('.draft-note').removeClass('hidden');
                $('.draft-note span.time').text(ret.time);
            }
        })
    }

    var draftSchedule;
    $(document).on('keyup', function () {
        clearTimeout(draftSchedule);
        draftSchedule = setTimeout(function () {
            draft();
        }, 60 * 1000);
    });

    $(window).on("beforeunload", function() {
        draft();
    });
</script>
<?php \mootensai\components\JsBlock::end() ?>
