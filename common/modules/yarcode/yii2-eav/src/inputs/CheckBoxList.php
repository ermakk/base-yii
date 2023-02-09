<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace yarcode\eav\inputs;

use common\models\ObjectAttributeValue;
use yarcode\eav\AttributeHandler;
use yii\helpers\ArrayHelper;

class CheckBoxList extends AttributeHandler
{
    public $selected = null;
    const VALUE_HANDLER_CLASS = 'yarcode\eav\MultipleOptionsValueHandler';

    public function init()
    {
        parent::init();

        $this->owner->addRule($this->getAttributeName(), 'in', [
            'range' => $this->getOptions(),
            'allowArray' => true,
        ]);
    }

    public function run($option = [])
    {
        $option['selected'] = array_key_exists('selected', $option) ? $option['selected'] : null;
        if ($this->owner->activeForm !== null) {
            return $this->owner->activeForm->field($this->owner, $this->getAttributeName())
                ->checkboxList(
                    ArrayHelper::map($this->attributeModel->getOptions()->asArray()->all(), 'id', 'value')
                );
        } else {

            if($this->attributeModel->attributes['selected'] == $option['selected']) {
                if($option['selected'] == false) {
                    $name = $this->attributeModel->name;
                    $OAVs = $this->attributeModel->getObjectAttributeValues()->andWhere(['entityId' => $this->owner->entityModel->id])->all();
                    $rOAV = [];
                    foreach ($OAVs as $OAV) {
                        /** @var ObjectAttributeValue $OAV */
                        $rOAV[] = $OAV->val;
                    }
                    return '<div class="persent-50">' . $name . ':</div> <div class="persent-50">' . ($rOAV ? implode(', ', $rOAV) : 'Не указано') . '</div>';
                } else {
                }
            }
        }

    }
}