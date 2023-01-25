<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace blacksesion\eav\widgets;

use blacksesion\eav\widgets\AttributeHandler;
use Yii;
use yii\helpers\ArrayHelper;

class RadioList extends AttributeHandler
{
    const VALUE_HANDLER_CLASS = '\blacksesion\eav\handlers\OptionValueHandler';

    static $order = 15;

    static $fieldView = <<<TEMPLATE
    <% for (i in (rf.get(Formbuilder.options.mappings.OPTIONS) || [])) { %>
    <div>
    <label class='fb-option'>
    <input type='radio' 
     <%= rf.get(Formbuilder.options.mappings.OPTIONS)[i].checked && 'checked' %> 
     <% if ( rf.get(Formbuilder.options.mappings.LOCKED) ) { %>disabled readonly<% } %> 
     onclick="javascript: return false;" 
    />
    <%= rf.get(Formbuilder.options.mappings.OPTIONS)[i].label %>
    </label>
    </div>
    <% } %>
    <% if (rf.get(Formbuilder.options.mappings.INCLUDE_OTHER)) { %>
    <div class='other-option'>
    <label class='fb-option'>
    <input type='radio' /> <%= Formbuilder.lang('Other') %></label>
    <input type='text' />
    </div>
    <% } %>    
TEMPLATE;

    static $fieldSettings = <<<TEMPLATE
    <%= Formbuilder.templates['edit/field_options']() %>
    <%= Formbuilder.templates['edit/options']({ includeOther: true }) %>    
TEMPLATE;

    static $fieldButton = <<<TEMPLATE
    <span class="symbol"><span class="fa fa-circle-o"></span></span> <%= Formbuilder.lang('Radio') %>    
TEMPLATE;

    static $defaultAttributes = <<<TEMPLATE
    function (attrs) {
            attrs.field_options.options = [
                {
                    label: "",
                    checked: false
                }, {
                    label: "",
                    checked: false
                }
            ];
            return attrs;
        }    
TEMPLATE;


    public function init()
    {
        parent::init();

        /*$this->owner->addRule($this->getAttributeName(), 'in', [
            'range' => $this->getOptions(),
        ]);*/
    }

    public function run()
    {
        $options = $this->attributeModel->getEavOptions()->asArray()->all();

        return $this->owner->activeForm->field(
            $this->owner, 
            $this->getAttributeName(),
            ['template' => "{input}\n{hint}\n{error}"])
            ->radioList(
                ArrayHelper::map($options, 'id', 'value')
            );
    }
}