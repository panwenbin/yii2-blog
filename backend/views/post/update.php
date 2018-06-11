<?php

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = '更新日志: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '日志列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新日志';
?>
<div class="post-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
