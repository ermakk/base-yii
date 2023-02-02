<?php

namespace frontend\controllers;

use common\models\Product;
use common\models\ProductCategory;
use common\models\ProductSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class ProductController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['index'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $this->layout = 'main';

        $category = null;
        if($_GET && array_key_exists('code', $_GET)) {
            $code = $_GET['code'];
            $category = ProductCategory::find()->where(['code' => $code])->one();

        }

        $searchModel = new ProductSearch();
        $products = $searchModel->search($this->request->queryParams);
        $products->sort->enableMultiSort = true;
        $products->setPagination([
            'pageSize' => 9
        ]);
        return $this->render('category_index',[
            'params' => $this->request->queryParams,
            'products' => $products,
            'category' => $category
        ]);
    }
    public function actionCategory($code = null)
    {
        $this->layout = 'main';
        $category = null;
        if ($code !== null && is_string($code)){
            if($category = ProductCategory::find()->where(['code' => $code])->one()){

                $searchModel = new ProductSearch();
                $params = $this->request->queryParams;
                $params['category_id'] = (string) $category->id;
                $products = $searchModel->search($params);
                $products->sort->enableMultiSort = true;
                $products->setPagination([
                    'pageSize' => 9
                ]);
                return $this->render('category_index', [
                    'params' => $this->request->queryParams,
                    'products' => $products,
                    'category' => $category
                ]);
            }

        } else {

            $searchModel = new ProductSearch();
            $products = $searchModel->search($this->request->queryParams);
            $products->sort->enableMultiSort = true;
            $products->setPagination([
                'pageSize' => 9
            ]);
        }
        return $this->render('category_index',[
            'params' => $this->request->queryParams,
            'products' => $products,
            'category' => $category
        ]);
    }

    public function actionView($code)
    {
        $product = Product::find()->where(['id'=> $code])->one();
        return $this->render('view',[
            'product' => $product
        ]);
    }
    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id Идентификтор
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
