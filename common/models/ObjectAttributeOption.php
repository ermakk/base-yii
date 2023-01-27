<?php

namespace common\models;

use yarcode\eav\models\AttributeOption;
use Yii;

/**
 * This is the model class for table "object_attribute_option".
 *
 * @property int $id
 * @property int|null $attributeId
 * @property string|null $value
 *
 * @property ObjectAttribute $attribute0
 * @property ObjectAttributeValue[] $objectAttributeValues
 * @property ObjectAttribute[] $objectAttributes
 */
class ObjectAttributeOption extends AttributeOption
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'object_attribute_option';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attributeId'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['attributeId'], 'exist', 'skipOnError' => true, 'targetClass' => ObjectAttribute::class, 'targetAttribute' => ['attributeId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attributeId' => 'Attribute ID',
            'value' => 'Value',
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
     * Gets query for [[ObjectAttributeValues]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObjectAttributeValues()
    {
        return $this->hasMany(ObjectAttributeValue::class, ['optionId' => 'id']);
    }

    /**
     * Gets query for [[ObjectAttributes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObjectAttributes()
    {
        return $this->hasMany(ObjectAttribute::class, ['defaultOptionId' => 'id']);
    }
}
