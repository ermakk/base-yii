<?php

namespace common\models;

use yarcode\eav\models\Attribute;
use Yii;

/**
 * This is the model class for table "object_attribute".
 *
 * @property int $id
 * @property int|null $categoryId
 * @property int|null $typeId
 * @property string|null $name
 * @property string|null $defaultValue
 * @property int|null $defaultOptionId
 * @property int|null $required
 *
 * @property ProductCategory $category
 * @property ObjectAttributeOption $defaultOption
 * @property ObjectAttributeOption[] $objectAttributeOptions
 * @property ObjectAttributeValue[] $objectAttributeValues
 * @property ObjectAttributeType $type
 */
class ObjectAttribute extends Attribute
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'object_attribute';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categoryId', 'typeId', 'defaultOptionId', 'required', 'selected'], 'integer'],
            [['name', 'defaultValue'], 'string', 'max' => 255],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::class, 'targetAttribute' => ['categoryId' => 'id']],
            [['defaultOptionId'], 'exist', 'skipOnError' => true, 'targetClass' => ObjectAttributeOption::class, 'targetAttribute' => ['defaultOptionId' => 'id']],
            [['typeId'], 'exist', 'skipOnError' => true, 'targetClass' => ObjectAttributeType::class, 'targetAttribute' => ['typeId' => 'id']],
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
            'typeId' => 'Type ID',
            'name' => 'Name',
            'defaultValue' => 'Default Value',
            'defaultOptionId' => 'Default Option ID',
            'required' => 'Required',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::class, ['id' => 'categoryId']);
    }

    /**
     * Gets query for [[DefaultOption]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultOption()
    {
        return $this->hasOne(ObjectAttributeOption::class, ['id' => 'defaultOptionId']);
    }

    /**
     * Gets query for [[ObjectAttributeOptions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObjectAttributeOptions()
    {
        return $this->hasMany(ObjectAttributeOption::class, ['attributeId' => 'id']);
    }

    /**
     * Gets query for [[ObjectAttributeValues]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObjectAttributeValues()
    {
        return $this->hasMany(ObjectAttributeValue::class, ['attributeId' => 'id']);
    }
    /**
     * Gets query for [[ObjectAttributeValues]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getValues($entityId = null)
    {
//        var_dump($this->hasOne(ObjectAttributeValue::class, ['attributeId' => 'id'])->where(['entityId' => $entityId])->one());
        return $this->hasOne(ObjectAttributeValue::class, ['attributeId' => 'id'])->where(['entityId' => $entityId])->one()['value'];
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ObjectAttributeType::class, ['id' => 'typeId']);
    }
}
