<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use common\models\User;
use frontend\models\SignupForm;

//Guia Autenticação - https://p0vidl0.info/yii2-api-guides/yii-filters-auth-httpbasicauth.html
class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function behaviors()
    {
        /* Debug */
        // var_dump($_SERVER['PHP_AUTH_USER']);
        // var_dump($_SERVER['PHP_AUTH_PW']);
        // die;

        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'except' => ['register'],
            'auth' => function ($username, $password)
            {
                $user = User::findByUsername($username);

                if ($user && $user->validatePassword($password))
                {
                    $this->user = $user;
                    return $user;
                }

                return $this->asJson(["response" => "Falha ao Autenticar!"]);
            },
        ];

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

    protected function verbs()
    {
        $verbs = parent::verbs();
        $verbs =  [
            'login' => ['GET'],
            'register' => ['POST'],
        ];

        return $verbs;
    }

    public function actionLogin()
    {
        $userID = $this->user->id;
        $role = 'client';
        if (!Yii::$app->authManager->getAssignment($role, $userID))
        {
            //TODO: Ativar a Exceção quando terminar os testes. Está comentado apenas porque o cliente criado ainda não tem roles.
            //throw new \yii\web\ForbiddenHttpException("Acesso Negado");
        }

        $token = $this->user->auth_key;

        return $this->asJson(["response" => $token]);
    }

    public function actionRegister()
    {
        $model = new SignupForm();
        $model->load(Yii::$app->request->post(), '');

        if ($model->signup())
        {
            return $this->asJson(["response" => "Sucesso"]);
        }

        return $this->asJson(["response" => $model->errors]);
    }
}
