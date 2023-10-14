<?php

namespace backend\modules\api\components;

use Yii;
use yii\filters\auth\AuthMethod;
use common\models\User;

class CustomAuth extends AuthMethod
{
    public function authenticate($user, $request, $response)
    {
        Yii::$app->params['id'] = null;

        try
        {
            $authToken = $request->getQueryString();

            if ($authToken == null)
            {
                throw new \yii\web\UnauthorizedHttpException('No authentication token provided');
            }

            $token = explode('=', $authToken)[1];
            $user = User::findIdentityByAccessToken($token);

            if (!$user)
            {
                throw new \yii\web\UnauthorizedHttpException('No authentication');
            }

            $userID = $user->id;
            $role = 'client';

            if (!Yii::$app->authManager->getAssignment($role, $userID))
            {
                throw new \yii\web\UnauthorizedHttpException('Unauthorized account');
            }

            Yii::$app->params['id'] = $user->id;

            return $user;
        }
        catch (\Exception $ex)
        {
            throw new \yii\web\UnauthorizedHttpException('No authentication');
        }
    }
}
