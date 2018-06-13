<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post_series_relation`.
 */
class m180612_142413_create_post_series_relation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post_series_relation}}', [
            'id' => $this->primaryKey(),
            'post_title' => $this->string()->notNull()->unique()->comment('日志标题'),
            'series_id' => $this->integer()->comment('系列ID'),
            'order' => $this->smallInteger()->comment('顺序'),
        ]);
        $this->createIndex('series_order', '{{%post_series_relation}}', ['series_id', 'order']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post_series_relation}}');
    }
}
