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

    <div class="blog-header">
        <h1><?= $post->title ?></h1>
        <span>本条日志发表于 <?= Yii::$app->getFormatter()->asDatetime($post->created_at) ?></span>
    </div>

    <div class="body-content">

        <?= Markdown::process($post->content) ?>

    </div>

    <div class="body-footer">
        <div><?= $post->prevPost ? Html::a('上一篇：' . $post->prevPost->title, Url::to(['', 'id' => $post->prevPost->id]), ['class' => 'btn btn-success']) : '' ?></div>
        <div><?= $post->nextPost ? Html::a('下一篇：' . $post->nextPost->title, Url::to(['', 'id' => $post->nextPost->id]), ['class' => 'btn btn-success']) : '' ?></div>
    </div>
</div>
