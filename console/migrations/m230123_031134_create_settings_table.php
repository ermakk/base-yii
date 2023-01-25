<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%settings}}`.
 */
class m230123_031134_create_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string()->notNull()->defaultValue('string')->comment('Тип данных'),
            'name' => $this->string()->notNull()->defaultValue('string')->comment('Имя поля'),
            'value' => $this->string()->notNull()->defaultValue('string')->comment('Значение')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%settings}}');
    }
}
