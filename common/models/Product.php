<?php

namespace common\models;

use ermakk\changelog\models\ActiveRecord;
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
//            [['color'], 'string', 'max' => 255], // Attribute field
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
            'eav' => [
                'class' => \mirocow\eav\EavBehavior::className(),
                'valueClass' => \mirocow\eav\models\EavAttributeValue::className(),
            ]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttributes()
    {
        return \mirocow\eav\models\EavAttribute::find()
            ->joinWith('entity')
            ->where([
                'eav_entity.categoryId' => $this->category_id,
                'eav_entity.entityModel' => $this::className()
            ]);
    }
    /**
     * @return \yii\db\ActiveQuery
     */

    public function renderEavAttr($attr, $model = NULL)
    {
        $optionValues = $model[$attr->name]->value; // Список выбранных значений
        $allOptionValues = $attr->getEavOptions()->asArray()->all(); // Список всех возможных значений

        // Если массив - все возможные значения
        unset($out);
        if (is_array($allOptionValues)) {
            $out = [];
            foreach ($allOptionValues as $allOtionValuesItem) {
                // Если список доступных значений - массив
                if (is_array($optionValues)) {
                    foreach ($optionValues as $optionValuesItem) {
                        if ($optionValuesItem == $allOtionValuesItem["id"]) {
                            $out[] = $allOtionValuesItem;
                        }
                    }
                } else {
                    if ($optionValues == $allOtionValuesItem["id"]) {
                        $out[] = $allOtionValuesItem;
                    }
                }
            }


        }

        if ($out) {
            return $out;
        } else return [0 => [
            'id' => 0,
            'attributeId' => 0,
            'value' => $model[$attr->name]['value'],
            'defaultOptionId' => 0,
            'order' => 0,

        ]];
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
