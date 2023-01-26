<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace yarcode\eav\modules\backend\controllers;

use yarcode\eav\models\Attribute;
use yarcode\eav\models\AttributeOption;
use yarcode\eav\modules\backend\Controller;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * Class OptionController
 * @package yarcode\eav\modules\backend\controllers
 */
class AttributeOptionController extends Controller
{
    /**
     * @param integer $attributeId
     * @return mixed
     */
    public function actionIndex($attributeId)
    {
        $attribute = $this->findAttributeModel($attributeId);

        $dataProvider = new ActiveDataProvider([
            'query' => $attribute->getOptions(),
        ]);

        return $this->render('index', [
            'attribute' => $attribute   ,
            'dataProvider' => $dataProvider,
            'entityName' => $this->getEntityName(),
        ]);
    }

    /**
     * @param integer $attributeId
     * @return mixed
     */
    public function actionCreate($attributeId)
    {
        $attribute = $this->findAttributeModel($attributeId);

        /** @var AttributeOption $model */
        $model = $this->getModelInstance('AttributeOption');
        $model->attributeId = $attribute->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->goBack();
        }

        return $this->render('create', [
            'model' => $model,
            'attribute' => $attribute,
            'entityName' => $this->getEntityName(),
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
            return $this->goBack();
        }

        return $this->render('update', [
            'model' => $model,
            'entityName' => $this->getEntityName(),
        ]);
    }

    /**
     * @param integer $id
     * @return Attribute the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = $this->getQueryInstance('AttributeOption')->where(['id' => $id])->one();
        if (!$model) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $model;
    }

    /**
     * @param integer $id
     * @return Attribute the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findAttributeModel($id)
    {
        $model = $this->getQueryInstance('Attribute')->where(['id' => $id])->one();
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
        $this->findModel($id)->delete();
        return $this->goBack();
    }
}
