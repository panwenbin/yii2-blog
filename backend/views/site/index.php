<?php

/* @var $this yii\web\View */
/* @var $numbers array */

use yii\helpers\Url;

$this->title = '控制台';
$this->title .= '- ' . Yii::$app->name;
?>
<div class="site-index">

    <a class="btn btn-primary" type="button" href="<?=Url::to(['post/index'])?>">
        日志 <span class="badge"><?=$numbers['post']?></span>
    </a>

</div>
