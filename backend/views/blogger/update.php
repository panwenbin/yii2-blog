<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Blogger */

$this->title = '更新: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '转载博客', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="blogger-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
