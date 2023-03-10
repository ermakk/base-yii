<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace yarcode\eav;

use yarcode\eav\models\AttributeValue;
use yii\db\ActiveRecord;

/**
 * Class MultipleOptionsValueHandler
 * @package yarcode\eav
 */
class MultipleOptionsValueHandler extends ValueHandler
{
    /** @var AttributeHandler */
    public $attributeHandler;

    /**
     * @inheritdoc
     */
    public function load()
    {
        $dynamicModel = $this->attributeHandler->owner;
        /** @var ActiveRecord $valueClass */
        $valueClass = $dynamicModel->valueClass;

        /** @var AttributeValue $models */
        $models = $valueClass::findAll([
            'entityId' => $dynamicModel->entityModel->getPrimaryKey(),
            'attributeId' => $this->attributeHandler->attributeModel->getPrimaryKey(),
        ]);

        $values = [];
        foreach ($models as $model) {
            $values[] = $model->optionId;
        }

        return $values;
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        $dynamicModel = $this->attributeHandler->owner;
        /** @var ActiveRecord $valueClass */
        $valueClass = $dynamicModel->valueClass;

        $baseQuery = $valueClass::find()->where([
            'entityId' => $dynamicModel->entityModel->getPrimaryKey(),
            'attributeId' => $this->attributeHandler->attributeModel->getPrimaryKey(),
        ]);

        $allOptions = [];
        foreach ($this->attributeHandler->attributeModel->options as $option) {
            $allOptions[] = $option->getPrimaryKey();
        }
        $query = clone $baseQuery;
        $query->andWhere("optionId NOT IN (:options)");
        if($valueClass::findAll($query->where, ['options' => implode(',', $allOptions)])) {
            $valueClass::deleteAll($query->where, [
                'options' => implode(',', $allOptions),
            ]);
        }

        // then we delete unselected options
        $selectedOptions = $dynamicModel->attributes[$this->attributeHandler->getAttributeName()];
        if (!is_array($selectedOptions))
            $selectedOptions = [];
        $deleteOptions = array_diff($allOptions, $selectedOptions);

        $query = clone $baseQuery;
        if(count($deleteOptions) > 0) {
            $query->andWhere("optionId IN ('".implode("', '", $deleteOptions)."')");
//            var_dump($valueClass::find()->where($query->where)->createCommand()->getRawSql()); die;
            if($valueClass::find()->where($query->where)) {
                $valueClass::deleteAll($query->where);
            }
        }

        // third we insert missing options
        foreach ($selectedOptions as $id) {
            $query = clone $baseQuery;
            $query->andWhere(['optionId' => $id]);

            /** @var AttributeValue $valueModel */
            $valueModel = $query->one();

            if (!$valueModel instanceof ActiveRecord) {
                $valueModel = new $valueClass;
                $valueModel->entityId = $dynamicModel->entityModel->getPrimaryKey();
                $valueModel->attributeId = $this->attributeHandler->attributeModel->getPrimaryKey();
                $valueModel->optionId = $id;
                if (!$valueModel->save())
                    throw new \Exception("Can't save value model");
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function getTextValue()
    {
        $dynamicModel = $this->attributeHandler->owner;
        /** @var ActiveRecord|string $valueClass */
        $valueClass = $dynamicModel->valueClass;

        /** @var AttributeValue[] $models */
        $models = $valueClass::findAll([
            'entityId' => $dynamicModel->entityModel->getPrimaryKey(),
            'attributeId' => $this->attributeHandler->attributeModel->getPrimaryKey(),
        ]);

        $values = [];
        foreach ($models as $model) {
            $values[] = $model->option->value;
        }

        return implode(', ', $values);
    }
}