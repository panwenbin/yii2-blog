<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '日志列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <span class="pull-right"><a data-toggle="隐藏搜索" href="#"
                                onclick="javascript:(function(ele){$('.post-search').toggle(); var data = $(ele).attr('data-toggle'); $(ele).attr('data-toggle', $(ele).html()); $(ele).html(data);})(this);">显示搜索</a></span>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('写日志', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function (\common\models\Post $post) {
                    return Html::a($post->title, ['view', 'id' => $post->id]);
                },
            ],
            [
                'label' => '作者',
                'attribute' => 'user.username',
            ],
            [
                'label' => '状态',
                'attribute' => 'statusTxt',
            ],
            'created_at:datetime',
        ],
    ]); ?>
</div>
