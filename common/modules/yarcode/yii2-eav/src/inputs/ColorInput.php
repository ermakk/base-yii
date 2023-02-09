<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace yarcode\eav\inputs;

use common\models\ObjectAttributeValue;
use yarcode\eav\AttributeHandler;
use yii\helpers\ArrayHelper;

class ColorInput extends AttributeHandler
{
    public $selected = null;
    public function init()
    {
        parent::init();
        $this->owner->addRule($this->getAttributeName(), 'string', ['max' => 255]);
    }

    public function run($option = [])
    {
        $option['selected'] = array_key_exists('selected', $option) ? $option['selected'] : null;
        if($this->owner->activeForm !==  null) {
            return $this->owner->activeForm->field($this->owner, $this->getAttributeName())
                ->widget(\kartik\color\ColorInput::class, [
                    'value' => 'red',
                    'showDefaultPalette' => false,
                    'options' => ['placeholder' => 'Choose your color ...'],
                    'pluginOptions' => [
                        'showInput' => true,
                        'showInitial' => true,
                        'showPalette' => true,
                        'showPaletteOnly' => true,
                        'showSelectionPalette' => true,
                        'showAlpha' => false,
                        'allowEmpty' => false,
                        'preferredFormat' => 'name',
                        'palette' => [
                            [
                                "white", "Snow", "MintCream", "DarkGray",  "Grey", "DimGrey", "Black"
                            ],
                            [
                                "IndianRed", "Salmon", "DarkRed", "Red", "Pink", "HotPink", "MediumVioletRed",
                            ],
                            [
                                "DarkOrange",  "Gold", "LemonChiffon", "Yellow",  "PapayaWhip", "Moccasin", "DarkKhaki",
                            ],
                            [
                                "Olive", "LimeGreen", "LightGreen", "Green", "YellowGreen", "DarkSeaGreen", "Teal"
                            ],
                            [
                                "Cyan", "Aquamarine", "CadetBlue",  "Blue", "LightBlue", "DeepSkyBlue", "DarkBlue"
                            ],
                            [
                                "DarkSlateBlue", "Indigo", "LightSteelBlue", "MediumSlateBlue", "MediumPurple", "Violet", "Purple"
                            ],
                        ]
                    ]
                ]);
//            return $this->owner->activeForm->field($this->owner, $this->getAttributeName())
//                ->textInput();
        }  else {
            if($this->attributeModel->attributes['selected'] == $option['selected']) {
                if($option['selected'] == false) {
                    $name = $this->attributeModel->name;
                    $OAVs = $this->attributeModel->getObjectAttributeValues()->andWhere(['entityId' => $this->owner->entityModel->id])->all();
                    $rOAV = [];
                    foreach ($OAVs as $OAV) {
                        /** @var ObjectAttributeValue $OAV */
                        $rOAV[] = $OAV->val;
                    }
                    if ($rOAV) {
                        if (is_array($rOAV)) {
                            $palett = "";
                            foreach ($rOAV as $rOAVel) {
                                $palett .= '<span style="display: block; width: 20px; height: 20px; background-color: ' . $rOAVel . '; margin-right: 5px"></span>';
                            }
                            return '<div class="persent-50">' . $name . ':</div> 
                            <div class="persent-50" style="display: flex; flex-direction: row; flex-wrap: wrap; justify-content: flex-start; align-content: center; align-items: center;">' . $palett . '</div>';
                        } else {
                            return '<div class="persent-50">' . $name . ':</div> <div class="persent-50"><span style="display: block; width: 20px; height: 20px; background-color: ' . $rOAV . ';"></span></div>';
                        }
                    } else {
                        return '<div class="persent-50">' . $name . ':</div> 
                            <div class="persent-50">Не указано</div>';
                    }
                } else {
                    $name = $this->attributeModel->name;
                    $OAVs = $this->attributeModel->getObjectAttributeValues()->andWhere(['entityId' => $this->owner->entityModel->id])->all();
                    $rOAV = [];
                    foreach ($OAVs as $OAV) {
                        /** @var ObjectAttributeValue $OAV */
                        $rOAV[] = [
                            'color' => $OAV->val,
                            'id' => $OAV->id
                        ];
                    }
                    if ($rOAV) {
                        if (is_array($rOAV)) {
                            $palett = "";
                            foreach ($rOAV as $rOAVel) {
                                $palett .= '<a data-attr="'.$rOAVel['id']. '"  onClick="'.$option['onclick']. '" style="display: block; width: 40px; height: 40px; background-color: ' . $rOAVel['color'] . '; margin-right: 5px"></a>';
                            }
                            return '<div class="persent-50">' . $name . ':</div> 
                            <div class="persent-50" style="display: flex; flex-direction: row; flex-wrap: wrap; justify-content: flex-start; align-content: center; align-items: center;">' . $palett . '</div>';
                        } else {
                            return '<div class="persent-50">' . $name . ':</div> <div class="persent-50"><a   data-attr="'.$rOAV['id']. '" onClick="'.$option['onclick']. '" style="display: block; width: 40px; height: 40px; background-color: ' . $rOAV['color'] . ';"></a></div>';
                        }
                    } else {
                        return '<div class="persent-50">' . $name . ':</div> 
                            <div class="persent-50">Не указано</div>';
                    }
                }
            }
        }
    }
}