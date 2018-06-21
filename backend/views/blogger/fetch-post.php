<?php
/**
 * @author Pan Wenbin <panwenbin@gmail.com>
 */

use yii\bootstrap\Html;
use yii\helpers\Url;

/* @var $blogger \common\models\Blogger */
/* @var $title string */
/* @var $content string */

$this->title = '抓取日志';
$this->params['breadcrumbs'][] = ['label' => '转载博客', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $blogger->name, 'url' => ['view', 'id' => $blogger->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blogger-fetch-post">
    <div class="form-group">
        <label class="control-label" for="post-title">标题</label>
        <?= Html::input('text', 'title', $title, ['id' => 'title', 'class' => 'form-control']) ?>
    </div>
    <div class="form-group">
        <label class="control-label" for="post-title">内容</label>
        <?= Html::textarea('content', $content, ['id' => 'content', 'class' => 'form-control', 'rows' => 30]) ?>
    </div>

    <div class="form-group">
        <?= Html::a('创建草稿', '', ['id' => 'create_draft', 'class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php \mootensai\components\JsBlock::begin() ?>
<script>
    $('#create_draft').click(function () {
        $(this).attr('disabled', 'disabled');
        $.post('<?=Url::to(['/api/draft/auto'])?>', {
            title: $('#title').val(),
            content: $('#content').val()
        }, function (ret) {
            if (ret.code == 200) {
                location.href = '<?=Url::to(['/post/create'])?>?draft_id=' + ret.id;
            }
        });
        $(this).removeAttr('disabled');
    })
</script>
<?php \mootensai\components\JsBlock::end() ?>
