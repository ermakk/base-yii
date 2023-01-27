<?php

namespace common\models;

use yarcode\eav\models\AttributeType;
use Yii;

/**
 * This is the model class for table "object_attribute_type".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $handlerClass
 * @property int $storeType
 *
 * @property ObjectAttribute[] $objectAttributes
 */
class ObjectAttributeType extends AttributeType
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'object_attribute_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['storeType'], 'integer'],
            [['name', 'handlerClass'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'handlerClass' => 'Handler Class',
            'storeType' => 'Store Type',
        ];
    }

    /**
     * Gets query for [[ObjectAttributes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObjectAttributes()
    {
        return $this->hasMany(ObjectAttribute::class, ['typeId' => 'id']);
    }
}
