<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BloggerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '转载博客列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blogger-index">

    <p>
        <?= Html::a('添加转载博客', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function (\common\models\Blogger $blogger) {
                    return Html::a($blogger->name, ['view', 'id' => $blogger->id]);
                },
            ],
            'index_url:url',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}'],
        ],
    ]); ?>
</div>
