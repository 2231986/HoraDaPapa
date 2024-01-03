<?php

namespace backend\modules\api\controllers;

use app\models\Meal;
use app\services\InvoiceHandler;
use app\models\Request;
use common\models\Plate;
use backend\modules\api\ApiResponse;
use yii\web\NotFoundHttpException;

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

	public function actionAddplate($mealid, $plateid)
	{
		$meal = Meal::findOne($mealid);
		$plate = Plate::findOne($plateid);

		if (!$meal)
		{
			throw new NotFoundHttpException('Meal not found.');
		}

		if (!$plate)
		{
			throw new NotFoundHttpException('Plate not found.');
		}

		$request = new Request();

		$request->meal_id = $meal->id;
		$request->isCooked = 0;
		$request->isDelivered = 0;
		$request->user_id = APIActiveController::getApiUser()->id;
		$request->plate_id = $plate->id;
		$request->price = $plate->price;

		if (\Yii::$app->request->isPost)
		{
			if (\Yii::$app->request->post('observation') != null)
			{
				$request->observation = \Yii::$app->request->post('observation');
			}

			if (\Yii::$app->request->post('quantity') != null)
			{
				$request->quantity = \Yii::$app->request->post('quantity');
			}
		}

		if ($request->save())
		{
			return ApiResponse::success([$request, 'Created successfully!']);
		}
		else
		{
			return ApiResponse::error([$request->errors, 'Failed to create request!']);
		}
	}

	public function actionRequests($id)
	{
		return Request::findAll(['meal_id' => $id]);
	}
}
