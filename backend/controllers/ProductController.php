<?php

namespace backend\controllers;

use common\models\File;
use common\models\ObjectAttributeValue;
use common\models\Product;
use common\models\ProductCategory;
use common\models\ProductSearch;
use yarcode\eav\DynamicModel;
use Yii;
use yii\base\Model;
use yii\helpers\BaseInflector;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param int $id Идентификтор
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $eav = $model->getEavModel(); /** @var DynamicModel $eav **/

//        $eav_attr = array_combine($eav->attributeLabels(), $eav->attributes);
        $eav_attr = [];
        foreach ($eav->attributeLabels() as $key => $attributeLabel){
            $eav_attr[] = [
                'attribute' => $key,
                'label' => $attributeLabel,
                'value' => ObjectAttributeValue::findOne(['entityId' => $id, 'attributeId' => $key])->val

            ];
        }
        //получаем список ссылок на изображения данной модели
//        var_dump($model->image_ids); die();
        foreach ($model->image_ids as $image_id){
            $model->image_list[] = File::findOne(['id' => $image_id]);
        }
//        var_dump(\yii\helpers\ArrayHelper::map($eav_attr, 'label','value'));
//        die;
        return $this->render('view', [
            'model' => $model,
            'eav_attr' => $eav_attr,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($category_id = null)
    {
        $model = new Product();
        $model->category_id = $category_id;
        $params = [
            'model' => $model,
            'categoryList' => ProductCategory::find()->all()
        ];
        if($category_id !== null ){
            $eav = $model->getEavModel(); /** @var DynamicModel $eav **/
            if ($this->request->isPost && $model->load($this->request->post())){

                if ($model->code == '') {
                    $model->code = BaseInflector::slug($model->title);
                }
//                var_dump(BaseInflector::slug($model->title)); die();
                if($model->save()) {
                    if ($eav->load(Yii::$app->request->post()) && $eav->validate()) {
                        $dbTransaction = Yii::$app->db->beginTransaction();
                        try {
                            $eav->save(false);
                            $dbTransaction->commit();
                        } catch (\Exception $e) {
                            $dbTransaction->rollBack();
                            throw $e;
                        }
                        return $this->redirect(['index']);
                    }
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }

            $params['eav'] = $eav;
        } else {

            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $model->loadDefaultValues();
            }
        }
        return $this->render('create', $params);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id Идентификтор
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

//        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }

//        if($this->request->isPost) {
//            var_dump($model);
//            die();
//        }
//        $model->setScenario('create');
        $eav = $model->getEavModel(); /** @var DynamicModel $eav **/
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            if ($eav->load(Yii::$app->request->post()) && $eav->validate()) {
                $dbTransaction = Yii::$app->db->beginTransaction();
                try {
                    $eav->save(false);
                    $dbTransaction->commit();
                } catch (\Exception $e) {
                    $dbTransaction->rollBack();
                    throw $e;
                }
                return $this->redirect(['index']);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }



        return $this->render('update', [
            'model' => $model,
            'eav' => $eav,
            'categoryList' => ProductCategory::find()->all()
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id Идентификтор
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(ObjectAttributeValue::deleteAll(['entityId' => $id])) {
            $this->findModel($id)->delete();
        }

        return $this->redirect(['index']);
    }
    /**
     * Deletes images an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id Идентификтор
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteImage($id)
    {
        if(Yii::$app->request->isPost){
            $image_id = Yii::$app->request->post('key');
            if($image_id !== null){
                if ($model = Product::findOne(['id' => $id])){
                    $image_array = $model->image_ids;
                    $model->image_ids = array_diff($image_array, [$image_id]);
                    return json_encode($model->save());
                }

            }
        }
        return json_encode(false);
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
