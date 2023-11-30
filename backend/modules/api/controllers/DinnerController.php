<?php

namespace backend\modules\api\controllers;

use app\models\Dinner;
use yii\web\NotFoundHttpException;

class DinnerController extends APIActiveController
{
	public $modelClass = 'backend\models\Dinner';

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
		return Dinner::find()->select('*')->all();
	}

	public function actionView($id)
	{
		$model = Dinner::find()->select(['*'])->where(['id' => $id])->one();

		if ($model === null)
		{
			throw new NotFoundHttpException('Model not found.');
		}

		return $model;
	}
}
