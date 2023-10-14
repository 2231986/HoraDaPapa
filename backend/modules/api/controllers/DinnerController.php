<?php

namespace backend\modules\api\controllers;

use yii\filters\auth\HttpBearerAuth;
use app\models\Dinner;


//Guia Autenticação - https://www.yiiframework.com/doc/guide/2.0/en/rest-authentication
class DinnerController extends APIActiveController
{
	public $modelClass = 'backend\models\Dinner';

	public function behaviors()
	{
		$behaviors = parent::behaviors();
		$behaviors['authenticator'] = [
			'class' => HttpBearerAuth::className(),
		];

		return $behaviors;
	}

	public function actionIndex()
	{
		return Dinner::find()->all();
	}
}
