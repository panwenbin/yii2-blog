<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blogger`.
 */
class m180621_115545_create_blogger_table extends Migration
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

        $this->createTable('blogger', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('博客名称'),
            'index_url' => $this->string()->notNull()->comment('列表网址'),
            'post_regexp' => $this->string()->comment('文章地址匹配规则'),
            'title_regexp' => $this->string()->comment('标题匹配规则'),
            'content_regexp' => $this->string()->comment('内容匹配规则'),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('blogger');
    }
}
