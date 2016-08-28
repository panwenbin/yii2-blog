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
        $this->createTable('{{%post_tag_relation}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull()->comment('日志ID'),
            'tag_id' => $this->integer()->notNull()->comment('TagID'),
        ]);
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
