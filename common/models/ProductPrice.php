<?php

namespace common\models;

use ermakk\changelog\models\ActiveRecord;
use Yii;

/**
 * This is the model class for table "product_price".
 *
 * @property int $id Идентификтор
 * @property int $value Стоимость
 * @property int $product_id Продукт
 * @property int $user_created Кто задал цену
 * @property int $created_at Время обновления
 *
 * @property Product $product
 * @property User $userCreated
 */
class ProductPrice extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value', 'product_id', 'user_created', 'created_at'], 'required'],
            [['value', 'product_id', 'user_created', 'created_at'], 'integer'],
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
            'value' => 'Стоимость',
            'product_id' => 'Продукт',
            'user_created' => 'Кто задал цену',
            'created_at' => 'Время обновления',
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
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUserCreated()
    {
        return $this->hasOne(User::class, ['id' => 'user_created']);
    }

    /**
     * {@inheritdoc}
     * @return ProductPriceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductPriceQuery(get_called_class());
    }
}
