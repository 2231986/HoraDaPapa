<?php

namespace backend\modules\api\controllers;

use common\models\Plate;
use yii\web\NotFoundHttpException;

class PlateController extends APIActiveController
{
	public $modelClass = 'common\models\Plate';

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
		return Plate::find()->select('id, description, price')->all();
	}

	public function actionView($id)
	{
		$model = Plate::find()->select(['id', 'description', 'price'])->where(['id' => $id])->one();

		if ($model === null)
		{
			throw new NotFoundHttpException('Model not found.');
		}

		return $model;
	}
}
