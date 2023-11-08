<?php

namespace backend\modules\api\controllers;

use app\models\Review;

class ReviewController extends APIActiveController
{
	public $modelClass = 'backend\models\Review';

	public function actionIndex()
	{
		return Review::find()->all();
	}
}
