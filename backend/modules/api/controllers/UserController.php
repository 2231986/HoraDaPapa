<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\AccessControl;
use common\models\User;
use frontend\models\SignupForm;

class UserController extends \yii\web\Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::class,
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
            'only' => ['login', 'register'],
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['login'],
                    'roles' => ['client'],
                ],
                [
                    'allow' => true,
                    'actions' => ['register'],
                    'roles' => ['?'],
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

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
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
            return $this->asJson(["response" => "Utilizador criado com sucesso!"]);
        }

        return $this->asJson(["response" => $model->errors]);
    }
}
