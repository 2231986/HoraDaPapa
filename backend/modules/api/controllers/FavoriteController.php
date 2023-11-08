<?php

namespace backend\modules\api\controllers;

use common\models\Favorite;

class FavoriteController extends APIActiveController
{
	public $modelClass = 'backend\models\Favorite';

	public function actionIndex()
	{
		return Favorite::find()->all();
	}
}
