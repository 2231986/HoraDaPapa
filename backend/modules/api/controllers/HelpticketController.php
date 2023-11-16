<?php

namespace backend\modules\api\controllers;

use Yii;
use app\models\Helpticket;
use yii\web\NotFoundHttpException;
use backend\modules\api\ApiResponse;

class HelpticketController extends APIActiveController
{
	public $modelClass = 'backend\models\Helpticket';

	protected function verbs()
	{
		$verbs = parent::verbs();
		$verbs =  [
			'index' => ['GET'],
			'create' => ['POST'],
			'delete' => ['DELETE'],
		];
		return $verbs;
	}

	public function actionIndex()
	{
		return Helpticket::find()
			->select(['id', 'description'])
			->where(['id_user' => APIActiveController::getApiUser()->id])
			->all();
	}

	public function actionCreate()
	{
		$model = new Helpticket();
		$model->load(Yii::$app->getRequest()->getBodyParams(), '');

		if ($model->save())
		{
			Yii::$app->getResponse()->setStatusCode(201); // Created
			return ApiResponse::success($model);
		}
		else
		{
			return ApiResponse::error([$model->errors]);
		}
	}

	public function actionDelete($id)
	{
		$model = $this->findModel($id);
		$model->delete();

		Yii::$app->getResponse()->setStatusCode(204); // No Content
		return null;
	}

	protected function findModel($id)
	{
		$model = Helpticket::findOne($id);

		if ($model === null)
		{
			throw new NotFoundHttpException('Model not found.');
		}

		return $model;
	}
}
