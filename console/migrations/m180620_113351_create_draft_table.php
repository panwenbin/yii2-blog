<?php

use yii\db\Migration;

/**
 * Handles the creation of table `draft`.
 */
class m180620_113351_create_draft_table extends Migration
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

        $this->createTable('draft', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('用户ID'),
            'post_id' => $this->integer()->comment('日志ID'),
            'title' => $this->string()->comment('标题'),
            'tags' => $this->string()->comment('标签'),
            'content' => $this->text()->notNull()->comment('草稿内容'),
            'updated_at' => $this->integer()->comment('修改时间'),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('draft');
    }
}
