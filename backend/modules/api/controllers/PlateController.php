<?php

namespace backend\modules\api\controllers;

use yii\filters\auth\HttpBearerAuth;
use common\models\Plate;

//Guia Autenticação - https://www.yiiframework.com/doc/guide/2.0/en/rest-authentication
class PlateController extends APIActiveController
{
	public $modelClass = 'common\models\Plate';

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
		return Plate::find()->select('id, description, price')->all();
	}
}
