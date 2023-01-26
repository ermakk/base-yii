<?php

use yii\db\Migration;

/**
 * Class m230125_131152_update_user_table
 */
class m230125_131152_update_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230125_131152_update_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230125_131152_update_user_table cannot be reverted.\n";

        return false;
    }
    */
}
