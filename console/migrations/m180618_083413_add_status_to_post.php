<?php

use yii\db\Migration;

/**
 * Class m180618_083413_add_status_to_post
 */
class m180618_083413_add_status_to_post extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('{{%post}}', 'status', $this->smallInteger()->notNull()->defaultValue(1)->comment('状态'));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('{{%post}}', 'status');
    }
}
