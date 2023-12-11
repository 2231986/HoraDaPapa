<?php

namespace backend\modules\api\controllers;

use Yii;
use app\models\Helpticket;
use yii\web\NotFoundHttpException;
use backend\modules\api\ApiResponse;
use console\controllers\RbacController;

class HelpticketController extends APIActiveController
{
	public $modelClass = 'backend\models\Helpticket';

	protected function verbs()
	{
		$verbs = parent::verbs();
		$verbs =  [
			'index' => ['GET'],
			'view' => ['GET'],
			'update' => ['PUT'],
			'create' => ['POST'],
			'delete' => ['DELETE'],
		];
		return $verbs;
	}

	public function actionIndex()
	{
		$query = Helpticket::find()->select(['id', 'description']);

		if (!APIActiveController::isApiUserAdmin())
		{
			$query->where(['user_id' => APIActiveController::getApiUser()->id]);
		}

		return $query->all();
	}

	public function actionView($id)
	{
		return $this->findModel($id);
	}

	public function actionCreate()
	{
		$model = new Helpticket();
		$model->load(Yii::$app->getRequest()->getBodyParams(), '');

		$model->user_id = APIActiveController::getApiUser()->id;
		$model->needHelp = 1;


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

	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		// Ensure that the user updating the helpticket is the owner (if not an admin)
		if (!APIActiveController::isApiUserAdmin() && $model->user_id !== APIActiveController::getApiUser()->id)
		{
			Yii::$app->getResponse()->setStatusCode(403);
			return ApiResponse::error(['You do not have permission to update this helpticket.']);
		}

		// Get the updated description from the PUT data
		$newDescription = Yii::$app->request->getBodyParam('description');

		// Update only the description field
		$model->description = $newDescription;

		if ($model->save())
		{
			Yii::$app->getResponse()->setStatusCode(200);
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
		$query = Helpticket::find()->select(['*'])->where(['id' => $id]);

		if (!APIActiveController::isApiUserAdmin())
		{
			$query->andWhere(['user_id' => APIActiveController::getApiUser()->id]);
		}

		$model = $query->one();

		if ($model === null)
		{
			throw new NotFoundHttpException('Model not found.');
		}

		return $model;
	}
}
