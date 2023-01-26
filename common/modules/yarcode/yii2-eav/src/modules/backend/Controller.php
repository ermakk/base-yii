<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace yarcode\eav\modules\backend;

use yarcode\eav\StorageModel;
use Yii;

/**
 * Class Controller
 * @package yarcode\eav\modules\backend
 *
 * @property Module $module
 */
class Controller extends \yii\web\Controller
{
    /**
     * @return string
     */
    protected function getEntityName()
    {
        return $this->module->entityName;
    }

    /**
     * @param string $class
     * @return StorageModel
     * @throws \yii\base\InvalidConfigException
     */
    protected function getModelInstance($class)
    {
        return Yii::createObject([
            'class' => $this->resolveModelClass($class),
        ]);
    }

    /**
     * @param string $class
     * @return string
     */
    protected function resolveModelClass($class)
    {
        return $this->getModelsNamespace() . '\\' . $class;
    }

    /**
     * @return string
     */
    protected function getModelsNamespace()
    {
        return $this->module->modelsNamespace;
    }

    /**
     * @param string $class
     * @return \yii\db\ActiveQuery
     */
    protected function getQueryInstance($class)
    {
        /** @var StorageModel|string $class */
        $class = $this->resolveModelClass($class);
        return $class::find();
    }
}

