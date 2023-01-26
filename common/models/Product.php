<?php

namespace common\models;

use ermakk\changelog\models\ActiveRecord;
use yarcode\eav\models\Attribute;
use yarcode\eav\models\AttributeValue;
use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id Идентификтор
 * @property string $title Название
 * @property string $code Символьный код
 * @property string|null $artikul Артикул
 * @property string|null $text Описание
 * @property int|null $category_id Категория
 * @property int|null $type_id Тип
 *
 * @property ProductCategory $category
 * @property ProductPrice[] $productPrices
 * @property ProductReceipt[] $productReceipts
 * @property ProductReview[] $productReviews
 * @property ProductType $type
 */
class Product extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'code'], 'required'],
            [['category_id', 'type_id'], 'integer'],
            [['title', 'code', 'artikul', 'text'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::class, 'targetAttribute' => ['category_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::class, 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификтор',
            'title' => 'Название',
            'code' => 'Символьный код',
            'artikul' => 'Артикул',
            'text' => 'Описание',
            'category_id' => 'Категория',
            'type_id' => 'Тип',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => \yarcode\eav\EavBehavior::className(),
                'valueClass' => AttributeValue::className(),
            ],
        ];
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getEavAttributes()
    {
        $query = Attribute::find();
        $query->multiple = true;
        return $query;
    }
    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|ProductCategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[ProductPrices]].
     *
     * @return \yii\db\ActiveQuery|ProductPriceQuery
     */
    public function getProductPrices()
    {
        return $this->hasMany(ProductPrice::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductReceipts]].
     *
     * @return \yii\db\ActiveQuery|ProductReceiptQuery
     */
    public function getProductReceipts()
    {
        return $this->hasMany(ProductReceipt::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductReviews]].
     *
     * @return \yii\db\ActiveQuery|ProductReviewQuery
     */
    public function getProductReviews()
    {
        return $this->hasMany(ProductReview::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ProductType::class, ['id' => 'type_id']);
    }

    /**
     * {@inheritdoc}
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
}
