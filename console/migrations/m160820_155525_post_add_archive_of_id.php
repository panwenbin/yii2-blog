<?php

use yii\db\Migration;

class m160820_155525_post_add_archive_of_id extends Migration
{
    public function up()
    {
        $this->addColumn('{{%post}}', 'archive_of_id', $this->integer()->comment('是哪篇的存档'));
    }

    public function down()
    {
        $this->dropColumn('{{%post}}', 'archive_of_id');
    }
}
