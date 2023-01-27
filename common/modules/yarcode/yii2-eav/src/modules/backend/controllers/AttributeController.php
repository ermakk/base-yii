<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace yarcode\eav\modules\backend\controllers;

use common\models\ObjectAttribute;
use common\models\ObjectAttributeOption;
use common\models\ProductCategory;
use yarcode\eav\models\Attribute;
use yarcode\eav\modules\backend\Controller;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * Class AttributeController
 * @package yarcode\eav\modules\backend\controllers
 */
class AttributeController extends Controller
{
    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getQueryInstance('ObjectAttribute'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'entityName' => $this->getEntityName(),
        ]);
    }

    /**
     * @return mixed
     */
    public function actionCreate()
    {
        /** @var ObjectAttribute $model */
        $model = $this->getModelInstance('ObjectAttribute');
        $model->required = true;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        $categoryList = ProductCategory::find()->all();

        $category_id = $this->request->get('category_id');
        if (isset($category_id) && $category_id !== null) {
            $model->categoryId = $category_id;
        }
        return $this->render('create', [
            'model' => $model,
            'entityName' => $this->getEntityName(),
            'typesQuery' => $this->getQueryInstance('ObjectAttributeType'),
            'categoryList' => $categoryList,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        $categoryList = ProductCategory::find()->all();
        return $this->render('update', [
            'model' => $model,
            'entityName' => $this->getEntityName(),
            'typesQuery' => $this->getQueryInstance('ObjectAttributeType'),
            'categoryList' => $categoryList,
        ]);
    }

    /**
     * @param integer $id
     * @return ObjectAttribute the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = $this->getQueryInstance('ObjectAttribute')->where(['id' => $id])->one();
        if (!$model) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $model;
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(ObjectAttributeOption::deleteAll(['attributeId' => $id])) {
            $this->findModel($id)->delete();
        }
        return $this->redirect(['index']);
    }
}
