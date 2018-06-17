<?php

use yii\db\Migration;

/**
 * Handles the creation of table `link`.
 */
class m180617_160842_create_link_table extends Migration
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

        $this->createTable('link', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('站点名称'),
            'url' => $this->string()->notNull()->comment('站点网址'),
            'created_at' => $this->integer()->comment('添加时间'),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('link');
    }
}
