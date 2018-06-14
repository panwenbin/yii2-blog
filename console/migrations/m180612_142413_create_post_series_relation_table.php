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
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%post_series_relation}}', [
            'id' => $this->primaryKey(),
            'post_title' => $this->string()->notNull()->unique()->comment('日志标题'),
            'series_id' => $this->integer()->comment('系列ID'),
            'order' => $this->smallInteger()->comment('顺序'),
        ], $tableOptions);
        $this->createIndex('series_order', '{{%post_series_relation}}', ['series_id', 'order']);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%post_series_relation}}');
    }
}
