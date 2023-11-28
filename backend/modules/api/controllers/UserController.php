<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\AccessControl;
use common\models\User;
use frontend\models\SignupForm;
use console\controllers\RbacController;
use yii\web\ForbiddenHttpException;
use backend\modules\api\ApiResponse;

class UserController extends \yii\web\Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        /* Debug */
        // var_dump($_SERVER['PHP_AUTH_USER']);
        // var_dump($_SERVER['PHP_AUTH_PW']);
        // die;

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

                return $this->asJson(ApiResponse::error([null, 'Falha ao Autenticar!']));
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
                    'roles' => [RbacController::$RoleAdmin, RbacController::$RoleClient],
                ],
                [
                    'allow' => true,
                    'actions' => ['register'],
                    'roles' => ['?'],
                ],
            ],
            'denyCallback' => function ()
            {
                throw new ForbiddenHttpException('Acesso negado!');
            },
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

        return $this->asJson(ApiResponse::success(['token' => $token]));
    }

    public function actionRegister()
    {
        $model = new SignupForm();
        $model->load(Yii::$app->request->post(), '');

        if ($model->signup())
        {
            Yii::$app->getResponse()->setStatusCode(201); // Created
            return $this->asJson(ApiResponse::success($model));
        }

        return $this->asJson(ApiResponse::error([$model->errors]));
    }
}
