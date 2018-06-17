<?php
/**
 * @author Pan Wenbin <panwenbin@gmail.com>
 */

use common\models\Link;
use common\models\Tag;
use yii\bootstrap\Html;
use yii\helpers\Url;

$links = Link::cachedLinks();
?>

<?= Html::beginForm(['site/search'], 'get', ['class' => "form-inline"]) ?>
    <div class="form-group">
        <label class="sr-only" for="s">搜索</label>
        <input type="text" class="form-control" id="s" name="s" placeholder="搜索">
    </div>
<?= Html::endForm() ?>

    <div class="tags">
        <h3>标签检索</h3>
        <div>
            <?php foreach (Tag::tagsWithFontSize() as $tag): ?>
                <?= Html::a($tag['name'], Url::to(['site/tag', 'tag' => $tag['name']]), ['style' => "font-size: {$tag['fontSize']}"]) ?>
            <?php endforeach; ?>
        </div>
    </div>

<?php if ($links): ?>
    <div class="links">
        <h3>友情链接</h3>
        <div>
            <ul>
                <?php foreach ($links as $link): ?>
                    <li><?= Html::a($link['name'], $link['url']) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>