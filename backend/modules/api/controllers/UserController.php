<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\AccessControl;
use common\models\User;
use frontend\models\SignupForm;

//Guia Autenticação - https://p0vidl0.info/yii2-api-guides/yii-filters-auth-httpbasicauth.html
class UserController extends APIActiveController
{
    public $modelClass = 'common\models\User';

    public function behaviors()
    {
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

        //ACF
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['client'],
                ],
            ],
        ];

        return $behaviors;
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
