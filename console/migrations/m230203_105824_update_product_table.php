<?php

use yii\db\Migration;

/**
 * Class m230203_105824_update_product_table
 */
class m230203_105824_update_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('product', 'text', $this->text()->comment('Описание'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230203_105824_update_product_table cannot be reverted.\n";
        $this->alterColumn('product', 'text', $this->string()->comment('Описание'));

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230203_105824_update_product_table cannot be reverted.\n";

        return false;
    }
    */
}
