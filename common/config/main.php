<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'user' => [
            'class' => \dektrium\user\Module::className(),
        ],
        'eav' => [
            'class' => 'mirocow\eav\Module',
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
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager', // or use 'yii\rbac\DbManager'
        ],
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
                    'basePath' => '@mirocow/eav/messages',
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
//        'authManager' => [
//            'class' => \dektrium\rbac\components\DbManager::className(),
//        ],
    ],

];
