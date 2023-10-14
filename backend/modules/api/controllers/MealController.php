<?php

namespace backend\modules\api\controllers;

use yii\filters\auth\HttpBearerAuth;
use app\models\Meal;


//Guia Autenticação - https://www.yiiframework.com/doc/guide/2.0/en/rest-authentication
class MealController extends APIActiveController
{
	public $modelClass = 'backend\models\Meal';

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
		return Meal::find()->all();
	}
}
