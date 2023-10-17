<?php

namespace backend\modules\api\controllers;

use common\models\Plate;

class PlateController extends APIActiveController
{
	public $modelClass = 'common\models\Plate';

	public function actionIndex()
	{
		return Plate::find()->select('id, description, price')->all();
	}
}
