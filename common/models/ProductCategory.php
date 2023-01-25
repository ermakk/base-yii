<?php

namespace common\models;

use ermakk\changelog\models\ActiveRecord;
use Yii;

/**
 * This is the model class for table "product_category".
 *
 * @property int $id Идентификтор
 * @property string $title Название
 * @property string $code Символьный код
 * @property string|null $comment Комментарий
 * @property int|null $parent_id Родительская категория
 *
 * @property ProductCategory $parent
 * @property ProductCategory[] $productCategories
 * @property Product[] $products
 */
class ProductCategory extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'code'], 'required'],
            [['parent_id'], 'integer'],
            [['title', 'code', 'comment', 'parentName'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::class, 'targetAttribute' => ['parent_id' => 'id']],
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
            'comment' => 'Комментарий',
            'parent_id' => 'Родительская категория',
            'parentName' => 'Родительская категория',
        ];
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery|ProductCategoryQuery
     */
    public function getParent()
    {
        return $this->hasOne(ProductCategory::class, ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[ProductCategories]].
     *
     * @return \yii\db\ActiveQuery|ProductCategoryQuery
     */
    public function getProductCategories()
    {
        return $this->hasMany(ProductCategory::class, ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['category_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getParentName(){
        if ($this->parent) {
            return $this->parent->title;
        } else {
            return '';
        }
    }

    /**
     * {@inheritdoc}
     * @return ProductCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductCategoryQuery(get_called_class());
    }
}
