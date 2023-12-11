<?php

namespace backend\modules\api\controllers;

use app\models\Review;
use yii\web\NotFoundHttpException;
use Yii;
use backend\modules\api\ApiResponse;

class ReviewController extends APIActiveController
{
	public $modelClass = 'backend\models\Review';

	protected function verbs()
	{
		$verbs = parent::verbs();
		$verbs =  [
			'index' => ['GET'],
			'view' => ['GET'],
			'create' => ['POST'],
			'update' => ['PUT'],
			'delete' => ['DELETE'],
		];
		return $verbs;
	}

	public function actionIndex()
	{
		$query = Review::find()->select(['*']);

		if (!APIActiveController::isApiUserAdmin())
		{
			$query->where(['user_id' => APIActiveController::getApiUser()->id]);
		}

		return $query->all();
	}

	public function actionView($id)
	{
		$query = Review::find()->select(['*'])->where(['id' => $id]);

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

	public function actionCreate()
	{
		$plateID = Yii::$app->request->post('plate_id');

		$model = Review::find()->select(['*'])
			->where(['user_id' => APIActiveController::getApiUser()->id])
			->andWhere(['plate_id' => $plateID])
			->one();

		if ($model == null)
		{
			$model = new Review();
			$model->load(Yii::$app->getRequest()->getBodyParams(), '');

			$model->user_id = APIActiveController::getApiUser()->id;

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
		else
		{
			\Yii::$app->getResponse()->setStatusCode(403);
			return ApiResponse::error(['O cliente já tem uma review para este prato!']);
		}
	}

	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if (!APIActiveController::isApiUserAdmin() && $model->user_id !== APIActiveController::getApiUser()->id)
		{
			Yii::$app->getResponse()->setStatusCode(403); // Forbidden
			return ApiResponse::error(['You do not have permission to update this review.']);
		}

		$model->load(Yii::$app->getRequest()->getBodyParams(), '');

		if ($model->save())
		{
			Yii::$app->getResponse()->setStatusCode(200); // OK
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

		if (!APIActiveController::isApiUserAdmin() && $model->user_id !== APIActiveController::getApiUser()->id)
		{
			Yii::$app->getResponse()->setStatusCode(403); // Forbidden
			return ApiResponse::error(['You do not have permission to delete this review.']);
		}

		$model->delete();

		Yii::$app->getResponse()->setStatusCode(204); // No Content
		return null;
	}

	protected function findModel($id)
	{
		$query = Review::find()->select(['*'])->where(['id' => $id]);

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
