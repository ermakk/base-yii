<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace yarcode\eav\inputs;

use common\models\ObjectAttributeValue;
use yarcode\eav\AttributeHandler;
use yii\helpers\ArrayHelper;

class TextInput extends AttributeHandler
{
    public function init()
    {
        parent::init();
        $this->owner->addRule($this->getAttributeName(), 'string', ['max' => 255]);
    }

    public function run()
    {
        if($this->owner->activeForm !==  null) {
            return $this->owner->activeForm->field($this->owner, $this->getAttributeName())
                ->textInput();
        }  else {
            $name = $this->attributeModel->name;
            $OAVs = $this->attributeModel->getObjectAttributeValues()->andWhere(['entityId' => $this->owner->entityModel->id])->all();
            $rOAV = [];
            foreach ($OAVs as $OAV){ /** @var ObjectAttributeValue $OAV  */
                $rOAV[] = $OAV->val;
            }
            return '<div class="persent-50">'.$name. ':</div> <div class="persent-50">'.($rOAV ? implode(', ', $rOAV) : 'Не указано').'</div>';
        }
    }
}