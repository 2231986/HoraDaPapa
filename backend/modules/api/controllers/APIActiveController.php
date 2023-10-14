<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;

class APIActiveController extends ActiveController
{
    public function behaviors()
    {
        /* Debug */
        // var_dump($_SERVER['PHP_AUTH_USER']);
        // var_dump($_SERVER['PHP_AUTH_PW']);
        // die;

        $behaviors = parent::behaviors();

        //Configure JSON output
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

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
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
