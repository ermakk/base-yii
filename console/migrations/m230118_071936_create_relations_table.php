<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%relations}}`.
 */
class m230118_071936_create_relations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%relations}}', [
            'id' => $this->primaryKey(),
            'model' => $this->string()->notNull()->comment(""),
            'from_id' => $this->integer()->notNull()->comment(""),
            'to_id' => $this->integer()->notNull()->comment("")
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%relations}}');
    }
}
