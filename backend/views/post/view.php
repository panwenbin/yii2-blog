<?php

use yii\helpers\Html;
use yii\helpers\Markdown;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '日志列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <?php if ($model->archive_of_id): ?>
        <div class="notify-latest">
            <h3>此篇日志为存档，请查看最新版本：</h3>
            <ul>
                <li><?= Html::a(Yii::$app->getFormatter()->asDate($model->latest->created_at) . ': ' . $model->latest->title, Url::to(['', 'id' => $model->latest->id])) ?></li>
            </ul>
        </div>
    <?php endif; ?>

    <p>
        <?= Html::a('更新日志', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除日志', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定要删除这篇日志吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="blog-header container-fluid bg-gray-light">
        <h1><?= $model->title ?></h1>
        <span>本条日志由 <?= $model->user->username ?>
            发表于 <?= Yii::$app->getFormatter()->asDatetime($model->created_at) ?></span>
        <span>
                <?php
                $tagHtmls = [];
                foreach ($model->tags as $tag) {
                    $tagHtmls[] = Html::a($tag->name, '#');
                }
                ?>
                <?= $tagHtmls ? '标签: ' . join(', ', $tagHtmls) : '' ?>
            </span>

            <?= Markdown::process($model->content, 'gfm') ?>
    </div>

    <?php if (is_null($model->archive_of_id)): ?>
        <?php if ($model->archives): ?>
            <div class="notify-archives">
                <h3>此篇日志有如下历史版本：</h3>
                <ul>
                    <?php foreach ($model->archives as $archivePost): ?>
                        <li><?= Html::a(Yii::$app->getFormatter()->asDate($archivePost->created_at) . ': ' . $archivePost->title, Url::to(['', 'id' => $archivePost->id])) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    <?php endif; ?>

</div>
