<?php
/* @var $this yii\web\View */
/* @var $diff mixed */
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <strong class="modal-title pull-left">变更内容</strong>
    <div class="clearfix"></div>
</div>
<div class="modal-body">
    <?php if ($diff === false): ?>
        <div class="alert alert-warning">未找到对比项</div>
    <?php elseif (empty($diff)): ?>
        <div class="alert alert-success">内容相同</div>
    <?php else: ?>
        <?= $diff ?>
    <?php endif; ?>
</div>
