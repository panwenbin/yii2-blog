<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%post_tag_relation}}`.
 */
class m160828_153552_create_post_tag_relation_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%post_tag_relation}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull()->comment('日志ID'),
            'tag_id' => $this->integer()->notNull()->comment('TagID'),
        ], $tableOptions);
        $this->createIndex('post_id', '{{%post_tag_relation}}', 'post_id');
        $this->createIndex('tag_id', '{{%post_tag_relation}}', 'tag_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%post_tag_relation}}');
    }
}
