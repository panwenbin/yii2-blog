<?php
/* @var $user \common\models\User */
$user = Yii::$app->user->identity;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => '后台菜单', 'options' => ['class' => 'header']],
                    ['label' => '日志管理', 'icon' => 'file-code-o', 'url' => ['/post']],
                    ['label' => '系列管理', 'icon' => 'book', 'url' => ['/series']],
                    ['label' => '草稿管理', 'icon' => 'file-archive-o', 'url' => ['/draft']],
                    ['label' => '转载博客', 'icon' => 'list', 'url' => ['/blogger']],
                    ['label' => '友情链接', 'icon' => 'link', 'url' => ['/link']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'], 'visible' => YII_DEBUG],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ],
            ]
        ) ?>

    </section>

</aside>
