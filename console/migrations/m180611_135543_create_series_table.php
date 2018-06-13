<?php

use yii\db\Migration;

/**
 * Handles the creation of table `series`.
 */
class m180611_135543_create_series_table extends Migration
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

        $this->createTable('{{%series}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('用户ID'),
            'title' => $this->string()->unique()->comment('标题'),
            'preface' => $this->text()->comment('序言'),
            'updated_at' => $this->integer()->comment('更新时间'),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%series}}');
    }
}
