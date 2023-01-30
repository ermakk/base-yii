<?php

use yii\db\Migration;

/**
 * Class m230117_061232_update_user_table
 */
class m230117_061232_update_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
//        $this->addColumn('{{%user}}', 'status', $this->smallInteger(6)->defaultValue(10));
//        $this->addColumn('{{%user}}', 'verification_token', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
//        $this->dropColumn('{{%user}}', 'status');
//        $this->dropColumn('{{%user}}', 'verification_token');
        echo "m230117_061232_update_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230117_061232_update_user_table cannot be reverted.\n";

        return false;
    }
    */
}
