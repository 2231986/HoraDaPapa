<?php

namespace backend\modules\api\controllers;

use yii\filters\auth\HttpBearerAuth;
use app\models\Favorite;


//Guia Autenticação - https://www.yiiframework.com/doc/guide/2.0/en/rest-authentication
class FavoriteController extends APIActiveController
{
	public $modelClass = 'backend\models\Favorite';

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
		return Favorite::find()->all();
	}
}
