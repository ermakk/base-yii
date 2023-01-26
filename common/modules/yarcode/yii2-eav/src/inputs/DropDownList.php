<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace yarcode\eav\inputs;

use yarcode\eav\AttributeHandler;
use yii\helpers\ArrayHelper;

class DropDownList extends AttributeHandler
{
    const VALUE_HANDLER_CLASS = 'yarcode\eav\OptionValueHandler';

    public function init()
    {
        parent::init();

        $this->owner->addRule($this->getAttributeName(), 'in', [
            'range' => $this->getOptions(),
        ]);
    }

    public function run()
    {
        return $this->owner->activeForm->field($this->owner, $this->getAttributeName())
            ->dropDownList(
                ArrayHelper::map($this->attributeModel->getOptions()->asArray()->all(), 'id', 'value')
            );
    }
}