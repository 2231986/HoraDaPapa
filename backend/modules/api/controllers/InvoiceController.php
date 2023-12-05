<?php

namespace backend\modules\api\controllers;

use app\models\Invoice;
use yii\web\NotFoundHttpException;
use yii\db\Expression;

class InvoiceController extends APIActiveController
{
	public $modelClass = 'backend\models\Invoice';

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
			return Invoice::find()->all();
		}
		else
		{
			$userId = APIActiveController::getApiUser()->id;

			return Invoice::find()->andWhere(['invoice.user_id' => $userId])->with([
				'meal' => function ($query) use ($userId)
				{
					$query->with([
						'requests' => function ($subQuery) use ($userId)
						{
							$subQuery->andWhere(['user_id' => $userId]);
						}
					]);
				}
			])->asArray()->all();
		}
	}

	public function actionView($id)
	{
		if (APIActiveController::isApiUserAdmin())
		{
			return Invoice::findOne($id);
		}
		else
		{
			$userId = APIActiveController::getApiUser()->id;

			return Invoice::find()->andWhere(['invoice.id' => $id])->andWhere(['invoice.user_id' => $userId])->with([
				'meal' => function ($query) use ($userId)
				{
					$query->with([
						'requests' => function ($subQuery) use ($userId)
						{
							$subQuery->andWhere(['user_id' => $userId]);
						}
					]);
				}
			])->asArray()->one();
		}
	}
}
