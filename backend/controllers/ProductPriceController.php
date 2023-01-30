<?php

namespace backend\controllers;

use common\models\Product;
use common\models\ProductPrice;
use common\models\ProductPriceSearch;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductPriceController implements the CRUD actions for ProductPrice model.
 */
class ProductPriceController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ProductPrice models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductPriceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductPrice model.
     * @param int $id Идентификтор
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductPrice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ProductPrice();

        $data_product = ArrayHelper::map((new Product())::find()->select(['CONCAT(id, " ", title, " (артикул: ", artikul, ", код: ", code, ")") AS title', 'id'])->all(), 'id', 'title');
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'data_product' => $data_product
        ]);
    }
    /**
     * Creates a new ProductPrice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreateAjax($pid){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new ProductPrice();
        if($pid !== null){
            $model->loadDefaultValues();
            $model->product_id = $pid;
        }
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return ['result' => true];
            }
        } else {
            return ['result' => false, 'error' => $model->errors];
        }
        return $this->renderAjax('create_ajax', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing ProductPrice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id Идентификтор
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data_product = ArrayHelper::map((new Product())::find()->select(['CONCAT(id, " ", title, " (артикул: ", artikul, ", код: ", code, ")") AS title', 'id'])->all(), 'id', 'title');

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'data_product' => $data_product
        ]);
    }

    /**
     * Deletes an existing ProductPrice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id Идентификтор
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductPrice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id Идентификтор
     * @return ProductPrice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductPrice::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
