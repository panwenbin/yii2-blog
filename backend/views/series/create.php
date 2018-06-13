<?php

/* @var $this yii\web\View */
/* @var $model common\models\Series */

$this->title = '新建系列';
$this->params['breadcrumbs'][] = ['label' => 'Series', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="series-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
