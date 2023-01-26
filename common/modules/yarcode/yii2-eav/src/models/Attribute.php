<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace yarcode\eav\models;

use yarcode\eav\StorageModel;
use Yii;

/**
 * This is the generic model class for the EAV attributes table.
 *
 * @property integer $id
 * @property integer $typeId
 * @property string $name
 * @property string $defaultValue
 * @property integer $defaultOptionId
 * @property integer $required
 *
 * @property AttributeOption $defaultOption
 * @property AttributeType $type
 * @property AttributeOption[] $options
 * @property AttributeValue[] $values
 */
abstract class Attribute extends StorageModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['typeId', 'name'], 'required'],
            [['typeId', 'defaultOptionId', 'required'], 'integer'],
            [['name', 'defaultValue'], 'string', 'max' => 255],
            ['name', 'unique'],
            ['defaultOptionId', 'exist', 'skipOnError' => true, 'targetClass' => $this->getAdjacentClass(self::CLASS_ATTRIBUTE_OPTION), 'targetAttribute' => ['defaultOptionId' => 'id']],
            ['typeId', 'exist', 'skipOnError' => true, 'targetClass' => $this->getAdjacentClass(self::CLASS_ATTRIBUTE_TYPE), 'targetAttribute' => ['typeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'typeId' => 'Type',
            'name' => 'Name',
            'defaultValue' => 'Default Value',
            'defaultOptionId' => 'Default Option',
            'required' => 'Required',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultOption()
    {
        return $this->hasOne($this->getAdjacentClass(self::CLASS_ATTRIBUTE_OPTION), ['id' => 'defaultOptionId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne($this->getAdjacentClass(self::CLASS_ATTRIBUTE_TYPE), ['id' => 'typeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasMany($this->getAdjacentClass(self::CLASS_ATTRIBUTE_OPTION), ['attributeId' => 'id']);
    }
}
