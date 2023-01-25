<?php

namespace ermakk\changelog;

use Yii;

/**
 * modues module definition class
 */
class ChangelogModule extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'ermakk\changelog\controllers';
    public $user =
        [
            'url' => '@mdm/user/view',
        ];
    public $propertyExclude = ['sorted'];
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
//        if (!isset(Yii::$app->i18n->translations['ermakk-changelog'])) {
//            Yii::$app->i18n->translations['ermakk-changelog'] = [
//                'class' => 'yii\i18n\PhpMessageSource',
//                'sourceLanguage' => 'en',
//                'basePath' => '@mdm/admin/messages',
//            ];
//        }
        // custom initialization code goes here
    }
    /**
     * Registration of translation class.
     */
    protected function registerTranslations()
    {
//        Yii::$app->i18n->translations['ermakk-changelog'] = [
//            'class' => 'yii\i18n\PhpMessageSource',
//            'sourceLanguage' => 'en',
//            'basePath' => '@ermakk/changelog/messages',
//            'fileMap' => [
//                'ermakk-changelog' => 'ermakk-changelog.php',
//            ],
//        ];
    }
}
