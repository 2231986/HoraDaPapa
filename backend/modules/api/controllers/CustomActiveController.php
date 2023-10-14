<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;

class CustomActiveController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = \yii\web\Response::FORMAT_JSON;

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();

        //Limpar ações default do ActiveRecord
        unset($actions['index']);
        unset($actions['update']);
        unset($actions['delete']);
        unset($actions['view']);
        unset($actions['create']);

        return $actions;
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;

        if ($exception !== null)
        {
            return ['response' => 'Endpoint não encontrado'];
        }
    }
}
