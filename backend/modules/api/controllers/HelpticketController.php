<?php

namespace backend\modules\api\controllers;

use app\models\Helpticket;

class HelpticketController extends APIActiveController
{
	public $modelClass = 'backend\models\Helpticket';

	public function actionIndex()
	{
		return Helpticket::find()->all();
	}
}
