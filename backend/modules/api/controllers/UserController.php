<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use common\models\User;

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
}
