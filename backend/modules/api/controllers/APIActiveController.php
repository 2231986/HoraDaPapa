<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use console\controllers\RbacController;

//Guia Autenticação - https://www.yiiframework.com/doc/guide/2.0/en/rest-authentication
class APIActiveController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        //Configure JSON output
        $behaviors['contentNegotiator']['formats']['text/html'] = \yii\web\Response::FORMAT_JSON;

        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];

        //ACF
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => [RbacController::$RoleClient],
                ],
            ],
        ];

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
