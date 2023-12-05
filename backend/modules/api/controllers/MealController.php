<?php

namespace backend\modules\api\controllers;

use app\models\Meal;
use app\services\InvoiceHandler;

class MealController extends APIActiveController
{
	public $modelClass = 'backend\models\Meal';

	protected function verbs()
	{
		$verbs = parent::verbs();
		$verbs =  [
			'index' => ['GET'],
			'view' => ['GET'],
		];
		return $verbs;
	}

	public function actionIndex()
	{
		if (APIActiveController::isApiUserAdmin())
		{
			return Meal::find()->all();
		}
		else
		{
			$userId = APIActiveController::getApiUser()->id;

			return Meal::find()->joinWith(['requests' => function ($query) use ($userId)
			{
				$query->andWhere(['user_id' => $userId]);
			}])->asArray()->all();
		}
	}

	public function actionView($id)
	{
		if (APIActiveController::isApiUserAdmin())
		{
			return Meal::findOne($id);
		}
		else
		{
			$userId = APIActiveController::getApiUser()->id;

			return Meal::find()->andWhere(['meal.id' => $id])->joinWith(['requests' => function ($query) use ($userId)
			{
				$query->andWhere(['user_id' => $userId]);
			}])->asArray()->one();
		}
	}

	public function actionInvoice($id)
	{
		return InvoiceHandler::GenerateInvoice($id, APIActiveController::getApiUser()->id);
	}
}
