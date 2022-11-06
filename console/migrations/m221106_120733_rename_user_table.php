<?php

use yii\db\Migration;

/**
 * Class m221106_120733_rename_user_table
 */
class m221106_120733_rename_user_table extends Migration
{
    public function up()
    {
        $this->renameTable('{{%user}}', '{{%users}}');
    }

    public function down()
    {
        $this->renameTable('{{%users}}', '{{%user}}');
    }
}
