<?php

/* @var $this yii\web\View */
/* @var $model common\models\Blogger */

$this->title = '添加博客';
$this->params['breadcrumbs'][] = ['label' => '博客列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blogger-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
