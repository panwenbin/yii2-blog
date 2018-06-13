<?php

use yii\helpers\Html;
use yii\helpers\Markdown;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Series */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Series', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="series-view">

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定要删除这个系列',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="container-fluid bg-gray-light">
        <h1><?= $model->title ?></h1>
        <span>本条日志由 <?= $model->user->username ?>
            更新于 <?= Yii::$app->getFormatter()->asDatetime($model->updated_at) ?></span>

        <h3>序言</h3>
        <?= Markdown::process($model->preface, 'gfm') ?>

        <h3>包含日志</h3>
        <?= Html::dropDownList('', '', explode(',', $model->postTitlesString), ['class' => 'form-control', 'multiple' => true]) ?>
        <br/>
    </div>

</div>
