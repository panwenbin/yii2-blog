<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%tag}}`.
 */
class m160828_153401_create_tag_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%tag}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()->comment('Tag名称'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%tag}}');
    }
}
