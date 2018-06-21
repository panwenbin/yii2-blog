<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Blogger */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '转载博客', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blogger-view">

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('抓取列表', ['fetch-index', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定要删除这个转载博客？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'index_url:url',
            'post_regexp',
            'title_regexp',
            'content_regexp',
        ],
    ]) ?>

</div>
