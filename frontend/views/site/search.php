<?php
/**
 * @author Pan Wenbin <panwenbin@gmail.com>
 */
use yii\bootstrap\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $s string */
/* @var $post \common\models\Post */

$this->title = '搜索' . $s;
?>

<div class="site-index col-md-10">
    <?php foreach ($dataProvider->models as $post): ?>
        <div class="blog-header">
            <h1><?= Html::a($post->title . ($post->isArchive() ? '[存档]' : ''), Url::to(['index', 'id' => $post->id])) ?></h1>
            <span>本条日志由 <?= $post->user->username ?>
                发表于 <?= Yii::$app->getFormatter()->asDatetime($post->created_at) ?></span>
            <span>
                <?php
                $tagHtmls = [];
                foreach ($post->tags as $tag) {
                    $tagHtmls[] = Html::a($tag->name, Url::to(['tag', 'tag' => $tag->name]));
                }
                ?>
                <?= $tagHtmls ? '标签: ' . join(', ', $tagHtmls) : '' ?>
            </span>
        </div>
    <?php endforeach; ?>
</div>
<div class="sidebar col-md-2">
    <?= Html::beginForm(['site/search'], 'get', ['class' => "form-inline"]) ?>
    <div class="form-group">
        <label class="sr-only" for="s">搜索</label>
        <?= Html::input('text', 's', $s, ['class' => 'form-control', 'placeholder' => '搜索']) ?>
    </div>
    <?= Html::endForm() ?>
</div>


