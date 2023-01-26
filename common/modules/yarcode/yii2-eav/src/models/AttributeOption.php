<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace yarcode\eav\models;

use yarcode\eav\StorageModel;
use Yii;

/**
 * This is the generic model class for the EAV attribute options table.
 *
 * @property integer $id
 * @property integer $attributeId
 * @property string $value
 */
abstract class AttributeOption extends StorageModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attributeId', 'value'], 'required'],
            [['attributeId'], 'integer'],
            [['value'], 'string', 'max' => 255],
            ['value', 'unique', 'filter' => ['attributeId' => $this->attributeId]],
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
            'attributeId' => 'Attribute',
            'value' => 'Value',
        ];
    }
}
