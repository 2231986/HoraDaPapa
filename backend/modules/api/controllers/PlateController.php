<?php

namespace backend\modules\api\controllers;

use Yii;
use app\models\Plate;
use backend\modules\api\components\CustomAuth;

class PlateController extends CustomActiveController
{
	public $modelClass = 'backend\models\Plate';

	public function behaviors()
	{
		$behaviors = parent::behaviors();
		$behaviors['authenticator'] = [
			'class' => CustomAuth::className(),
		];

		return $behaviors;
	}

	public function actionIndex()
	{
		return Plate::find()->select('id, description, price')->all();
	}
}
