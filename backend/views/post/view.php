<?php

use yii\helpers\Html;
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

    <h1><?= Html::encode($this->title) ?></h1>

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'user.username',
                'label' => '作者',
            ],
            'title',
            [
                'attribute' => 'tagNames',
                'value' => join(',', $model->getTagNames()),
            ],
            'content:markdown',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

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
