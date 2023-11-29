<?php

namespace backend\modules\api\controllers;

use common\models\Plate;

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
		return Plate::find()->select(['id', 'description', 'price'])->where(['id' => $id])->one();
	}
}
