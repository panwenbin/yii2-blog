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

$this->title = '搜索: ' . $s;
?>

<div class="col-md-10">
    <h1><?= $this->title ?></h1>
    <?php if ($dataProvider->models): ?>
        <?php foreach ($dataProvider->models as $post): ?>
            <div class="blog-header">
                <h2><?= Html::a($post->title . ($post->isArchive() ? '[存档]' : ''), $post->isArchive() ? Url::to(['index', 'id' => $post->id]) : Url::to(['index', 'title' => $post->title])) ?></h2>
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
    <?php else: ?>
        <h3>没有找到日志</h3>
    <?php endif; ?>
</div>
<div class="sidebar col-md-2">
    <?= $this->render('_sidebar') ?>
</div>

