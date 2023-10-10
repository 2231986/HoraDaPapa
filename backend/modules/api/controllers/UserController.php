<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function actionInfo()
    {
        echo Yii::$app->Mosquitto->publish();
    }
}
