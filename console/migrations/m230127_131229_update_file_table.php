<?php

use yii\db\Migration;

/**
 * Class m230127_131229_update_file_table
 */
class m230127_131229_update_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('file', [
            'id' => $this->primaryKey()->comment('Идентификатор'),
            'originalName' => $this->string()->comment('Оригинальное имя файла'),
            'hash' => $this->string()->comment('Хеш сумма'),
            'path' => $this->string()->comment('Путь до файла'),
            'format' => $this->string()->comment('Расширение файла'),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->addColumn('relations', 'relation_model', $this->string()->comment('Связная модель'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230127_131229_update_file_table cannot be reverted.\n";
        $this->dropTable('file');
        $this->dropColumn('relations', 'relation_model');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230127_131229_update_file_table cannot be reverted.\n";

        return false;
    }
    */
}
