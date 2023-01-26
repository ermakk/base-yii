<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace yarcode\eav;

use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

abstract class StorageModel extends ActiveRecord
{
    const CLASS_ATTRIBUTE = 'ObjectAttribute';
    const CLASS_ATTRIBUTE_TYPE = 'ObjectAttributeType';
    const CLASS_ATTRIBUTE_OPTION = 'ObjectAttributeOption';
    const CLASS_ATTRIBUTE_VALUE = 'ObjectAttributeValue';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        throw new InvalidConfigException('Please override this method in class' . get_called_class());
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        $reflector = new \ReflectionClass(get_called_class());
        return $reflector->getNamespaceName();
    }

    /**
     * @param string $class
     * @return string
     */
    public function getAdjacentClass($class)
    {
        return $this->getNamespace() . '\\' . $class;
    }
}