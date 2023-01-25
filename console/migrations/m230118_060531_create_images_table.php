<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%images}}`.
 */
class m230118_060531_create_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%images}}', [
            'id' => $this->primaryKey(),
            'file' => $this->string()->notNull()->comment(""),
            'originalName' => $this->string()->comment(""),
            'hash' => $this->string()->notNull()->comment(""),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%images}}');
    }
}
