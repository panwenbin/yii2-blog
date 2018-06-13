<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SeriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '系列';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="series-index">

    <p>
        <?= Html::a('新建系列', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function (\common\models\Series $series) {
                    return Html::a($series->title, ['view', 'id' => $series->id]);
                },
            ],
            [
                'attribute' => 'user.username',
                'label' => '用户',
            ],
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}'],
        ],
    ]); ?>
</div>
