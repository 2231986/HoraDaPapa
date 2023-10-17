<?php

namespace backend\modules\api\controllers;

use app\models\Request;

class RequestController extends APIActiveController
{
	public $modelClass = 'backend\models\Request';

	public function actionIndex()
	{
		return Request::find()->all();
	}
}
