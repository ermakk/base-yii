<?php

namespace blacksesion\eav\widgets;

use blacksesion\eav\models\EavAttribute;
use blacksesion\eav\EavModel;
use yii\helpers\Html;

class ActiveField extends \yii\widgets\ActiveField
{

    public function init()
    {
        parent::init();
        /*$this->owner->addRule($this->getAttributeName(), 'in', [
            'range' => $this->getOptions(),
            'allowArray' => true,
        ]);*/
    }

    public function eavInput($options = [])
    {
        $options = array_merge($this->inputOptions, $options);
        $options['form'] = $this->form;
        return $this->renderField($this->model, $this->attribute, $options);
    }

    private function renderField($model, $attribute, $options)
    {
        $this->adjustLabelFor($options);
        $eavModel = EavModel::create(['entityModel' => $model , 'attribute'=>$attribute, 'valueClass'=>\blacksesion\eav\models\EavAttributeValue::className()]);
        $handler = $eavModel->handlers[$attribute];
        $handler->owner->activeForm = $options['form'];
        unset($options['form']);
        $handler->options = $options;

        /** @var EavAttribute $attributeModel */
        $attributeModel = $handler->attributeModel;

        /** @var ActiveField $model */
        $model = $handler->run();
        $model->label($attributeModel->label);
        $model->hint($attributeModel->description);
        $this->parts = $model->parts;

        /** Add required attribute */
        if ($attributeModel->required) {
            $this->options['class'] .= ' ' . $this->form->requiredCssClass;
        }

        return $this;

    }
}