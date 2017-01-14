<?php

use yii\db\Migration;

class m170114_175502_post_user_id_nullable extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%post}}', 'user_id', $this->integer()->comment('用户ID'));
    }

    public function down()
    {
        $this->alterColumn('{{%post}}', 'user_id', $this->integer()->notNull()->comment('用户ID'));
    }
}
