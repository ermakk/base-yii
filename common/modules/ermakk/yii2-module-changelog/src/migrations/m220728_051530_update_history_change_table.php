<?php

use yii\db\Migration;

/**
 * Class m220728_051530_update_history_change_table
 */
class m220728_051530_update_history_change_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('ermakk_history_change', 'fields', $this->text()->comment('Изменения в полях'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->update('ermakk_history_change', ['fields'],  [$this->string()->comment('Поля')]);
        echo "m220728_051530_update_history_change_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220728_051530_update_history_change_table cannot be reverted.\n";

        return false;
    }
    */
}
