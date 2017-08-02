<?php

/* @var $this yii\web\View */
/* @var $post common\models\Post */
/* @var $id integer */
/* @var \common\models\Post[] $relatedPosts */

use yii\bootstrap\Html;
use yii\helpers\Markdown;
use yii\helpers\Url;

nezhelskoy\highlight\HighlightAsset::register($this);

$this->title = $id ? $post->title . ' - ' : '';
$this->title .= Yii::$app->name;
?>
<div class="site-index col-md-10">
    <?php if ($post): ?>
        <?php if ($post->archive_of_id): ?>
            <div class="notify-latest">
                <h3>此篇日志为存档，请查看最新版本：</h3>
                <ul>
                    <li><?= Html::a(Yii::$app->getFormatter()->asDate($post->latest->created_at) . ': ' . $post->latest->title, Url::to(['', 'title' => $post->latest->title])) ?></li>
                </ul>
            </div>
        <?php endif; ?>

        <div class="blog-header">
            <h1><?= $post->title ?></h1>
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

        <div class="body-content">

            <?= Markdown::process($post->content, 'gfm') ?>

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
                <div class="pull-left"><?= $post->nextPost ? Html::a('< 新一篇：' . $post->nextPost->title, Url::to(['', 'title' => $post->nextPost->title]), ['class' => 'btn btn-success']) : '' ?></div>
                <div class="pull-right"><?= $post->prevPost ? Html::a('> 前一篇：' . $post->prevPost->title, Url::to(['', 'title' => $post->prevPost->title]), ['class' => 'btn btn-success']) : '' ?></div>
            </div>

            <?php if ($relatedPosts): ?>
                <div class="related">
                    <h3>相关日志</h3>
                    <ul>
                        <?php foreach ($relatedPosts as $relatedPost): ?>
                            <li><?= Html::a($relatedPost->title, Url::to(['', 'title' => $relatedPost->title])) ?>
                                [<?= Yii::$app->getFormatter()->asDate($relatedPost->created_at) ?>]
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php else: ?>
        <h3>目前还没有日志</h3>
    <?php endif; ?>
</div>
<div class="sidebar col-md-2">
    <?= $this->render('_sidebar') ?>
</div>