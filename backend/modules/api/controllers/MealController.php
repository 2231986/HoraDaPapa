<?php

namespace backend\modules\api\controllers;

use app\models\Dinner;
use app\models\Invoice;
use app\models\Meal;
use app\models\Request;
use common\components\Mosquitto;
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
		$meal = Meal::findOne($id);

		if (!$meal)
		{
			throw new NotFoundHttpException('Meal not found.');
		}

		$requests = $meal->getRequests()->all();

		$invoiceTotalPrice = 0;
		foreach ($requests as $request)
		{
			$invoiceTotalPrice += $request->price;
		}

		$userInfo = APIActiveController::getApiUser()->getUserInfo()->one();
		$userInfoNIF = "999999999";
		if ($userInfo->nif)
		{
			$userInfoNIF = $userInfo->nif;
		}

		$invoice = new Invoice();
		$invoice->meal_id = $id;
		$invoice->price = $invoiceTotalPrice;
		$invoice->nif = $userInfoNIF;

		$invoice->save();

		$meal->checkout = 1;
		$meal->save();

		$dinner = Dinner::findOne($meal->dinner_table_id);
		$dinner->isClean = 0;
		$dinner->save();

		\Yii::$app->Mosquitto->publish(Mosquitto::getTopic(APIActiveController::getApiUser()->id), 'Fatura Emitida!');

		return [
			'dinner' => $dinner,
			'meal' => $meal,
			'invoice' => $invoice,
			'requests' => $requests,
		];
	}
}
