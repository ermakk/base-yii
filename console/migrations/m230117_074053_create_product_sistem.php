<?php

use yii\db\Migration;

/**
 * Class m230117_074053_create_product_sistem
 */
class m230117_074053_create_product_sistem extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            '{{%product_type}}',
            [
                'id' => $this->primaryKey()->comment('Идентификтор'),
                'title' => $this->string()->notNull()->comment('Название'),
                'code' => $this->string()->notNull()->comment('Символьный код'),
                'comment' => $this->string()->comment('Комментарий'),
            ]
        );
        $this->createTable(
            '{{%product_category}}',
            [
                'id' => $this->primaryKey()->comment('Идентификтор'),
                'title' => $this->string()->notNull()->comment('Название'),
                'code' => $this->string()->notNull()->comment('Символьный код'),
                'comment' => $this->string()->comment('Комментарий'),
                'parent_id' => $this->integer()->defaultValue(null)->comment('Родительская категория')
            ]
        );
        $this->addForeignKey("FK_PCAT_TO_PCAT",
            '{{%product_category}}',
            'parent_id',
            '{{%product_category}}',
            'id'
        );
        $this->createTable(
            '{{%product}}',
            [
                'id' => $this->primaryKey()->comment('Идентификтор'),
                'title' => $this->string()->notNull()->comment('Название'),
                'code' => $this->string()->notNull()->comment('Символьный код'),
                'artikul' => $this->string()->comment('Артикул'),
                'text' => $this->string()->comment('Описание'),
                'category_id' => $this->integer()->comment('Категория'),
                'type_id' => $this->integer()->comment('Тип')
            ]
        );

        $this->addForeignKey("FK_PRODUCT_TO_CATEGORY",
            '{{%product}}',
            'category_id',
            '{{%product_category}}',
            'id'
        );
        $this->addForeignKey("FK_PRODUCT_TO_TYPE",
            '{{%product}}',
            'type_id',
            '{{%product_type}}',
            'id'
        );
        $this->createTable(
            '{{%product_price}}',
            [
                'id' => $this->primaryKey()->comment('Идентификтор'),
                'value' => $this->integer()->notNull()->comment('Стоимость'),
                'product_id' => $this->integer()->notNull()->comment('Продукт'),
                'user_created' => $this->integer()->notNull()->comment('Кто задал цену'),
                'created_at' => $this->integer()->notNull()->comment('Время обновления')
            ]
        );

        $this->addForeignKey("FK_PPRICE_TO_PRODUCT",
            '{{%product_price}}',
            'product_id',
            '{{%product}}',
            'id'
        );
        $this->addForeignKey("FK_PPRICE_TO_USER",
            '{{%product_price}}',
            'user_created',
            '{{%user}}',
            'id'
        );
        $this->createTable(
            '{{%product_review}}',
            [
                'id' => $this->primaryKey()->comment('Идентификтор'),
                'value' => $this->text()->notNull()->comment('Отзыв'),
                'product_id' => $this->integer()->notNull()->comment('Продукт'),
                'user_created' => $this->integer()->notNull()->comment('Пользователь')
            ]
        );

        $this->addForeignKey("FK_PREVIEW_TO_PRODUCT",
            '{{%product_review}}',
            'product_id',
            '{{%product}}',
            'id'
        );
        $this->addForeignKey("FK_PREVIEW_TO_USER",
            '{{%product_review}}',
            'user_created',
            '{{%user}}',
            'id'
        );
        $this->createTable(
            '{{%product_receipt}}',
            [
                'id' => $this->primaryKey()->comment('Идентификтор'),
                'count' => $this->integer()->notNull()->defaultValue(0)->comment('Количество'),
                'receipt' => $this->boolean()->defaultValue(true)->comment('Поступление'),
                'product_id' => $this->integer()->notNull()->comment('Продукт'),
                'user_created' => $this->integer()->notNull()->comment('Пользователь')
            ]
        );
        $this->addForeignKey("FK_PRECEIPT_TO_PRODUCT",
            '{{%product_receipt}}',
            'product_id',
            '{{%product}}',
            'id'
        );
        $this->addForeignKey("FK_PRECEIPT_TO_USER",
            '{{%product_receipt}}',
            'user_created',
            '{{%user}}',
            'id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable(
            '{{%product_type}}'
        );
        $this->dropForeignKey("FK_PCAT_TO_PCAT",
            '{{%product_category}}'
        );
        $this->dropTable(
            '{{%product_category}}'
        );
        $this->dropForeignKey("FK_PRODUCT_TO_CATEGORY",
            '{{%product}}'
        );
        $this->dropForeignKey("FK_PRODUCT_TO_TYPE",
            '{{%product}}'
        );
        $this->dropTable(
            '{{%product}}'
        );


        $this->dropForeignKey("FK_PPRICE_TO_PRODUCT",
            '{{%product_price}}'
        );
        $this->dropForeignKey("FK_PPRICE_TO_USER",
            '{{%product_price}}'
        );
        $this->dropTable(
            '{{%product_price}}'
        );
        $this->dropForeignKey("FK_PREVIEW_TO_PRODUCT",
            '{{%product_review}}'
        );
        $this->dropForeignKey("FK_PREVIEW_TO_USER",
            '{{%product_review}}'
        );
        $this->dropTable(
            '{{%product_review}}'
        );

        $this->dropForeignKey("FK_PRECEIPT_TO_PRODUCT",
            '{{%product_receipt}}'
        );
        $this->dropForeignKey("FK_PRECEIPT_TO_USER",
            '{{%product_receipt}}'
        );
        $this->dropTable(
            '{{%product_receipt}}'
        );
        echo "m230117_074053_create_product_sistem cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230117_074053_create_product_sistem cannot be reverted.\n";

        return false;
    }
    */
}
