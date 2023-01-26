<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace yarcode\eav\models;

use yarcode\eav\StorageModel;
use Yii;

/**
 * This is the generic model class for the EAV values table.
 *
 * @property integer $id
 * @property integer $entityId
 * @property integer $attributeId
 * @property string $value
 * @property integer $optionId
 *
 * @property AttributeOption $option
 * @property Attribute $attribute
 */
abstract class AttributeValue extends StorageModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entityId', 'attributeId', 'optionId'], 'integer'],
            ['value', 'string', 'max' => 255],
            ['optionId', 'exist', 'skipOnError' => true, 'targetClass' => $this->getAdjacentClass(self::CLASS_ATTRIBUTE_OPTION), 'targetAttribute' => ['optionId' => 'id']],
            ['attributeId', 'exist', 'skipOnError' => true, 'targetClass' => $this->getAdjacentClass(self::CLASS_ATTRIBUTE), 'targetAttribute' => ['attributeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entityId' => 'Entity',
            'attributeId' => 'Attribute',
            'value' => 'Value',
            'optionId' => 'Option',
        ];
    }
}
