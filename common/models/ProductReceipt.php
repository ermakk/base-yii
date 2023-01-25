<?php

namespace common\models;

use ermakk\changelog\models\ActiveRecord;
use Yii;

/**
 * This is the model class for table "product_receipt".
 *
 * @property int $id Идентификтор
 * @property int $count Количество
 * @property int|null $receipt Поступление
 * @property int $product_id Продукт
 * @property int $user_created Пользователь
 *
 * @property Product $product
 * @property User $userCreated
 */
class ProductReceipt extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_receipt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['count', 'receipt', 'product_id', 'user_created'], 'integer'],
            [['product_id', 'user_created'], 'required'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
            [['user_created'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_created' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификтор',
            'count' => 'Количество',
            'receipt' => 'Поступление',
            'product_id' => 'Продукт',
            'user_created' => 'Пользователь',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery|ProductQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    /**
     * Gets query for [[UserCreated]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUserCreated()
    {
        return $this->hasOne(User::class, ['id' => 'user_created']);
    }

    /**
     * {@inheritdoc}
     * @return ProductReceiptQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductReceiptQuery(get_called_class());
    }
}
