<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%post}}`.
 */
class m160814_163057_create_post_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('用户ID'),
            'title' => $this->string()->notNull()->comment('标题'),
            'content' => $this->text()->notNull()->comment('内容'),
            'created_at' => $this->integer()->comment('发布时间'),
            'updated_at' => $this->integer()->comment('修改时间'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%post}}');
    }
}
