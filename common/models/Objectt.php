<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "object".
 *
 * @property int $id
 * @property int|null $categoryId
 *
 * @property ObjectCategory $category
 * @property ObjectAttributeValue[] $objectAttributeValues
 */
class Objectt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'object';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categoryId'], 'integer'],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => ObjectCategory::class, 'targetAttribute' => ['categoryId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categoryId' => 'Category ID',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ObjectCategory::class, ['id' => 'categoryId']);
    }

    /**
     * Gets query for [[ObjectAttributeValues]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObjectAttributeValues()
    {
        return $this->hasMany(ObjectAttributeValue::class, ['entityId' => 'id']);
    }
}
