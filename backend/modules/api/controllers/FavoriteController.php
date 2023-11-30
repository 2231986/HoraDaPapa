<?php

namespace backend\modules\api\controllers;

use common\models\Favorite;
use yii\web\NotFoundHttpException;

class FavoriteController extends APIActiveController
{
	public $modelClass = 'backend\models\Favorite';

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
		$query = Favorite::find()->select(['*']);

		if (!APIActiveController::isApiUserAdmin())
		{
			$query->where(['user_id' => APIActiveController::getApiUser()->id]);
		}

		return $query->all();
	}

	public function actionView($id)
	{
		$query = Favorite::find()->select(['*'])->where(['id' => $id]);

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
}
