<?php

namespace backend\modules\api\controllers;

use app\models\Meal;

class MealController extends APIActiveController
{
	public $modelClass = 'backend\models\Meal';

	public function actionIndex()
	{
		return Meal::find()->all();
	}
}
