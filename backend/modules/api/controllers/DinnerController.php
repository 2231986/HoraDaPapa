<?php

namespace backend\modules\api\controllers;

use app\models\Dinner;

class DinnerController extends APIActiveController
{
	public $modelClass = 'backend\models\Dinner';

	public function actionIndex()
	{
		return Dinner::find()->all();
	}
}
