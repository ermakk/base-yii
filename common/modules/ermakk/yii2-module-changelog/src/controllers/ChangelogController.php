<?php

namespace ermakk\changelog\controllers;

use ermakk\changelog\models\Changelog;
use phpDocumentor\Reflection\Types\This;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\debug\models\timeline\DataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Default controller for the `modues` module
 */
class ChangelogController extends Controller
{

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [

                        //COMMON
                        [
                            'actions' => ['index'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
//                        [
//                            'actions' => [],
//                            'allow' => true,
//                            'roles' => ['?']
//                        ],


                    ],
                ],
            ]
        );
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($pageSize = 50)
    {
        $sql = Changelog::find()->where(['user_id' => Yii::$app->user->getId(), 'statusRead' => 0]);

        $log = new ActiveDataProvider([
            'query' => $sql,
            'pagination' => [
                'pageSize' => $pageSize
            ],
            'sort' => [
                'defaultOrder' => [
                    'date' => SORT_DESC,
                ]
            ],
        ]);
        return $this->render('index', [
            'log' => $log
        ]);

    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionDrop($id, $class)
    {
        return $this->render('index');
    }
}
