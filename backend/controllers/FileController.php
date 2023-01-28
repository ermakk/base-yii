<?php

namespace backend\controllers;

class FileController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRemove()
    {
        return $this->render('remove');
    }

    public function actionUpload()
    {
        return json_encode($this);
        return $this->render('upload');
    }

}
