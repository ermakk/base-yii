<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%history_change}}`.
 */
class m220727_092240_create_history_change_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ermakk_history_change}}', [
            'id' => $this->primaryKey(),
            'model' => $this->string()->notNull()->comment('Класс модели'),
            'row_id' => $this->integer()->notNull()->comment('ИД записи'),
            'user_id' => $this->integer()->notNull()->comment('ИД пользователя'),
            'action' => $this->string()->comment('Действие'),
            'fields' => $this->string()->comment('Поля'),
            'date' => $this->integer()->comment('Дата'),
            'comment' => $this->string()->comment('Комментарий'),
            'statusRead' => $this->boolean()->defaultValue('0')->comment('Статус прочтения')
        ]);

        $this->addForeignKey(
            'FK_HC_to_user',
            '{{%ermakk_history_change}}',
            'user_id',
            'user',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_HC_to_user', '{{%ermakk_history_change}}');
        $this->dropTable('{{%ermakk_history_change}}');
    }
}
