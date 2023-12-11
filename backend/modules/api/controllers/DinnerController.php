<?php

namespace backend\modules\api\controllers;

use app\models\Dinner;
use app\models\Meal;
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

	public function actionClean()
	{
		return Dinner::find()->select('*')->where(['isClean' => 1])->all();
	}

	public function actionStart($id)
	{
		$dinner = Dinner::find()->select('*')->where(['id' => $id])->andWhere(['isClean' => 1])->one();

		if ($dinner == null)
		{
			throw new NotFoundHttpException('Mesa não está disponível');
		}

		$meal = Meal::find()->select('*')->where(['dinner_table_id' => $dinner->id])->andWhere(['checkout' => 0])->one();

		if ($meal == null)
		{
			$meal = new Meal();
			$meal->dinner_table_id = $id;
			$meal->checkout = 0;
			$meal->save();
		}

		return $dinner;
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
