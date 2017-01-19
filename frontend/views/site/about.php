<?php

/* @var $this yii\web\View */
/* @var $aboutMd \common\models\Post */

use yii\helpers\Markdown;

$this->title = '关于我';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="body-content">
        <?= $aboutMd ? Markdown::process($aboutMd->content, 'gfm') : '<code>请在后台发表一个标题为about的日志，内容就会显示在这一页。</code>' ?>
    </div>
</div>
