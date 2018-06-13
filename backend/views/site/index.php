<?php

/* @var $this yii\web\View */

/* @var $numbers array */

use yii\helpers\Url;

$this->title = '控制台';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

    <a href="<?= Url::to(['post/index']) ?>">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fa fa-file-text-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">日志</span>
                    <span class="info-box-number"><?= $numbers['post'] ?></span>
                </div>
            </div>
        </div>
    </a>
    <a href="<?= Url::to(['series/index']) ?>">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">系列</span>
                    <span class="info-box-number"><?= $numbers['series'] ?></span>
                </div>
            </div>
        </div>
    </a>

</div>
