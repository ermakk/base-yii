<?php

use yii\db\Migration;

/**
 * Class m230208_082439_update_object_attribute_table
 */
class m230208_082439_update_object_attribute_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('object_attribute', 'selected', $this->boolean()->defaultValue(false)->comment('Выбираемый аттрибут'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('object_attribute', 'selected');
        echo "m230208_082439_update_object_attribute_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230208_082439_update_object_attribute_table cannot be reverted.\n";

        return false;
    }
    */
}
