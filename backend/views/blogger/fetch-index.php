<?php
/**
 * @author Pan Wenbin <panwenbin@gmail.com>
 */

use common\helpers\UrlHelper;
use common\models\Draft;
use common\models\Post;
use yii\bootstrap\Html;
use yii\helpers\Url;

/* @var $blogger \common\models\Blogger */
/* @var $posts array */

$this->title = '抓取列表';
$this->params['breadcrumbs'][] = ['label' => '转载博客', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $blogger->name, 'url' => ['view', 'id' => $blogger->id]];
$this->params['breadcrumbs'][] = $this->title;

$postsExists = Post::find()->select('id, title')->where(['title' => array_column($posts, 'title'), 'archive_of_id' => null])->asArray()->indexBy('title')->all();
$draftsExists = Draft::find()->select('id, title')->where(['title' => array_column($posts, 'title')])->asArray()->indexBy('title')->all();
?>

<div class="blogger-fetch-index">
    <table class="table">
        <thead>
        <tr>
            <td>标题</td>
            <td>原文</td>
            <td>已转</td>
            <td>草稿</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($posts as $post): ?>
            <?php
            $url = Url::to(['fetch-post', 'id' => $blogger->id, 'url' => $post['url']]);
            $title = $post['title'];
            $postExists = isset($postsExists[$title]) ? Html::a($postsExists[$title]['id'], ['post/view', 'id' => $postsExists[$title]['id']]) : '';
            $draftExists = isset($draftsExists[$title]) ? Html::a($draftsExists[$title]['id'], ['draft/view', 'id' => $draftsExists[$title]['id']]) : '';
            echo '<tr><td>', Html::a($title, $url), '</td>', '<td>',Html::a('查看', UrlHelper::urlAbsolutely($post['url'], $blogger->index_url), ['target' => '_blank']),'</td>', "<td>{$postExists}</td><td>{$draftExists}</td></tr>";
            ?>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
