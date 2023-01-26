<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace yarcode\eav\modules\backend;

/**
 * Class Module
 * @package yarcode\eav\modules\backend
 */
class Module extends \yii\base\Module
{
    public $entityName = 'Sample Entity';
    public $modelsNamespace = 'common\models\sample_eav';

    public $defaultRoute = 'attribute';
    public $controllerNamespace = 'yarcode\eav\modules\backend\controllers';
}
