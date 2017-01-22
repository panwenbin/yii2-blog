<?php
/**
 * @author Pan Wenbin <panwenbin@gmail.com>
 */
use yii\bootstrap\Html;
use yii\helpers\Url;

/* @var $tag \common\models\Tag */
?>
<div class="col-md-10">
    <div class="blog-header">
        <h1>标签: [<?= $tag ? $tag->name : '' ?>]</h1>
        <span>所标记的日志列表</span>
    </div>
    <ul>
        <?php if ($tag) foreach ($tag->notArchivedPosts as $post): ?>
            <li><?= Html::a(Yii::$app->getFormatter()->asDate($post->created_at) . ': ' . $post->title, Url::to(['site/index', 'title' => $post->title])) ?></li>
        <?php endforeach; ?>
    </ul>
</div>

<div class="sidebar col-md-2">
    <?= $this->render('_sidebar') ?>
</div>