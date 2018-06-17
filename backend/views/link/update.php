<?php

/* @var $this yii\web\View */
/* @var $model common\models\Link */

$this->title = '修改友情链接: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '友情链接', 'url' => ['index']];
$this->params['breadcrumbs'][] = '修改' . $model->name;
?>
<div class="link-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
