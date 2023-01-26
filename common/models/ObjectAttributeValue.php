<?php

namespace common\models;

use yarcode\eav\models\AttributeValue;
use Yii;

/**
 * This is the model class for table "object_attribute_value".
 *
 * @property int $id
 * @property int|null $entityId
 * @property int|null $attributeId
 * @property string|null $value
 * @property int|null $optionId
 *
 * @property ObjectAttribute $attribute0
 * @property Product $entity
 * @property ObjectAttributeOption $option
 */
class ObjectAttributeValue extends AttributeValue
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'object_attribute_value';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entityId', 'attributeId', 'optionId'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['attributeId'], 'exist', 'skipOnError' => true, 'targetClass' => ObjectAttribute::class, 'targetAttribute' => ['attributeId' => 'id']],
            [['entityId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['entityId' => 'id']],
            [['optionId'], 'exist', 'skipOnError' => true, 'targetClass' => ObjectAttributeOption::class, 'targetAttribute' => ['optionId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entityId' => 'Entity ID',
            'attributeId' => 'Attribute ID',
            'value' => 'Value',
            'optionId' => 'Option ID',
        ];
    }

    /**
     * Gets query for [[Attribute0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute0()
    {
        return $this->hasOne(ObjectAttribute::class, ['id' => 'attributeId']);
    }

    /**
     * Gets query for [[Entity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntity()
    {
        return $this->hasOne(Product::class, ['id' => 'entityId']);
    }

    /**
     * Gets query for [[Option]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOption()
    {
        return $this->hasOne(ObjectAttributeOption::class, ['id' => 'optionId']);
    }
    /**
     * Gets query for [[Option]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVal()
    {
        if($this->optionId !== null) {
            return $this->hasOne(ObjectAttributeOption::class, ['id' => 'optionId'])->one()->value;
        } else {
            return $this->value;
        }
    }
}
