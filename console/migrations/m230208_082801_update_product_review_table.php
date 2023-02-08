<?php

use yii\db\Migration;

/**
 * Class m230208_082801_update_product_review_table
 */
class m230208_082801_update_product_review_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product_review', 'reating', $this->float()->comment('Рейтинг от 0 до 5'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('product_review', 'reating');
        echo "m230208_082801_update_product_review_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230208_082801_update_product_review_table cannot be reverted.\n";

        return false;
    }
    */
}
