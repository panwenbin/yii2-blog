<?php

use common\models\Draft;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DraftSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '草稿';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="draft-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function (Draft $draft) {
                    return Html::a($draft->title, Url::to(['view', 'id' => $draft->id]));
                }
            ],
            [
                'attribute' => 'user.username',
                'label' => '用户名',
            ],
            'post_id',

            'tags',
            //'content:ntext',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {delete}'],
        ],
    ]); ?>
</div>
