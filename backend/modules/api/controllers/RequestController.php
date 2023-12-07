<?php

namespace backend\modules\api\controllers;

use app\models\Request;
use yii\web\NotFoundHttpException;
use common\models\Plate;
use backend\modules\api\ApiResponse;
use app\models\Meal;

class RequestController extends APIActiveController
{
	public $modelClass = 'backend\models\Request';

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
		$query = Request::find()->select(['*']);

		if (!APIActiveController::isApiUserAdmin())
		{
			$query->where(['user_id' => APIActiveController::getApiUser()->id]);
		}

		return $query->all();
	}

	public function actionView($id)
	{
		$query = Request::find()->select(['*'])->where(['id' => $id]);

		if (!APIActiveController::isApiUserAdmin())
		{
			$query->andWhere(['user_id' => APIActiveController::getApiUser()->id]);
		}

		$model = $query->one();

		if ($model === null)
		{
			throw new NotFoundHttpException('Model not found.');
		}

		return $model;
	}

	public function actionCreate($mealid, $plateid)
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
}
