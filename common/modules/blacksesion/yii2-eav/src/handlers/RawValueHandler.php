<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace blacksesion\eav\handlers;

/**
 * Class RawValueHandler
 * @package blacksesion\eav
 */
class RawValueHandler extends ValueHandler
{
    /**
     * @inheritdoc
     */
    public function load()
    {
        $valueModel = $this->getValueModel();
        return $valueModel->value;
    }

    /**
     * @inheritdoc
     */
    public function defaultValue()
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        $EavModel = $this->attributeHandler->owner;
        $valueModel = $this->getValueModel();
        $attribute = $this->attributeHandler->getAttributeName();

        if (isset($EavModel->attributes[$attribute])) {

            $valueModel->value = $EavModel->attributes[$attribute];
            if (!$valueModel->save(false)) {
                throw new \Exception("Can't save value model");
            }

        }
    }

    public function getTextValue()
    {
        return $this->getValueModel()->value;
    }
}