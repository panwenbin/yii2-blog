<?php

/* @var $this yii\web\View */
/* @var $post common\models\Post */
/* @var $id integer */

use yii\bootstrap\Html;
use yii\helpers\Markdown;
use yii\helpers\Url;

$this->title = $id ? $post->title . ' - ' : '';
$this->title .= Yii::$app->name;
?>
<div class="site-index">

    <?php if ($post): ?>
        <?php if ($post->archive_of_id): ?>
            <div class="notify-latest">
                <h3>此篇日志为存档，请查看最新版本：</h3>
                <ul>
                    <li><?= Html::a(Yii::$app->getFormatter()->asDate($post->latest->created_at) . ': ' . $post->latest->title, Url::to(['', 'id' => $post->latest->id])) ?></li>
                </ul>
            </div>
        <?php endif; ?>

        <div class="blog-header">
            <h1><?= $post->title ?></h1>
            <span>本条日志发表于 <?= Yii::$app->getFormatter()->asDatetime($post->created_at) ?></span>
        </div>

        <div class="body-content">

            <?= Markdown::process($post->content) ?>

        </div>

        <?php if (is_null($post->archive_of_id)): ?>
            <?php if ($post->archives): ?>
                <div class="notify-archives">
                    <h3>此篇日志有如下历史版本：</h3>
                    <ul>
                        <?php foreach ($post->archives as $archivePost): ?>
                            <li><?= Html::a(Yii::$app->getFormatter()->asDate($archivePost->created_at) . ': ' . $archivePost->title, Url::to(['', 'id' => $archivePost->id])) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>


            <div class="body-footer">
                <div><?= $post->nextPost ? Html::a('< 新一篇：' . $post->nextPost->title, Url::to(['', 'id' => $post->nextPost->id]), ['class' => 'btn btn-success']) : '' ?></div>
                <div><?= $post->prevPost ? Html::a('> 前一篇：' . $post->prevPost->title, Url::to(['', 'id' => $post->prevPost->id]), ['class' => 'btn btn-success']) : '' ?></div>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <h3>目前还没有日志</h3>
    <?php endif; ?>
</div>
