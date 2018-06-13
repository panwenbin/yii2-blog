<?php

/* @var $this yii\web\View */
/* @var $model common\models\Series */

$this->title = '更新系列: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '系列', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="series-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
