<?php
/**
 * @author Pan Wenbin <panwenbin@gmail.com>
 */

use yii\helpers\Markdown;
use yii\helpers\Url;

/* @var \common\models\Series $series */
?>
<div class="site-index col-md-10">
    <div class="blog-header">
        <h1><?= $series->title ?></h1>
        <span>本条日志由 <?= $series->user->username ?>
            更新于 <?= Yii::$app->getFormatter()->asDatetime($series->updated_at) ?></span>
    </div>

    <div class="body-content">

        <h3>序言</h3>
        <?= Markdown::process($series->preface, 'gfm') ?>

        <h3>目录</h3>
        <ul>
            <?php foreach ($series->postSeriesRelations as $postSeriesRelation): ?>
                <li>
                    <a href="<?= Url::to(['index', 'title' => $postSeriesRelation->post_title]) ?>">
                        <?= $postSeriesRelation->post_title ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>


</div>

<div class="sidebar col-md-2">
    <?= $this->render('_sidebar') ?>
</div>