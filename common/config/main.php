<?php


return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'name' => 'Touristika',
    'language' => 'RU-ru',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'extensions' => yii\helpers\ArrayHelper::merge(
        require(dirname(dirname(__DIR__)) . '/vendor/yiisoft/extensions.php'),
        [
            'yarcode/yii2-eav' => [
                'name' => 'yarcode/yii2-eav',
                'version' => '0.3.2',
                'alias' => [
                    '@yarcode/eav' => '@common/modules/yarcode/yii2-eav/src',
                ],
            ],
        ]
    ),
    'modules' => [
        'user' => [
            'class' => \dektrium\user\Module::className(),
        ],
        'eav' => [
            'class' => \yarcode\eav\modules\backend\Module::class,
        ],
        'rbac' => 'dektrium\rbac\RbacWebModule',
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', 'localhost', '::1'],
            'generators' => [
                'migrik' => [
                    'class' => \insolita\migrik\gii\StructureGenerator::class,
                    'templates' => [
                        'custom' => '@backend/gii/templates/migrator_schema',
                    ],
                ],
                'migrikdata' => [
                    'class' => \insolita\migrik\gii\DataGenerator::class,
                    'templates' => [
                        'custom' => '@backend/gii/templates/migrator_data',
                    ],
                ],
            ],
        ],
        'changelog' => [
            'class' => \ermakk\changelog\ChangelogModule::className(),
        ],
    ],
    'components' => [
        'assetManager' => [
            'bundles' => [
                'kartik\form\ActiveFormAsset' => [
                    'bsVersion' => 4,
                    'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//        'authManager' => [
//            'class' => 'yii\rbac\PhpManager', // or use 'yii\rbac\DbManager'
//        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app'       => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
                'eav' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@blacksesion/eav/messages',
                ],
                'ermakk-changelog' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en',
                    'basePath' => 'ermakk/changelog/messages',
                    'fileMap' => [
                        'ermakk-changelog' => 'ermakk-changelog.php',
                    ],
                ],
            ],
        ],
        'authManager' => [
            'class' => \dektrium\rbac\components\DbManager::className(),
        ],
    ],

];
