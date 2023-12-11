<?php

namespace backend\modules\api\controllers;

use common\models\Favorite;
use common\models\Plate;
use backend\modules\api\ApiResponse;
use yii\web\NotFoundHttpException;

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
		return Plate::find()->select('*')->all();
	}

	public function actionView($id)
	{
		return $this->findModel($id);
	}

	public function actionAddfavorite($id)
	{
		$plate = $this->findModel($id);


		$favorite = Favorite::find()->select(['*'])
			->where(['user_id' => APIActiveController::getApiUser()->id])
			->andWhere(['plate_id' => $plate->id])
			->one();

		if ($favorite == null)
		{
			$favorite = new Favorite();
			$favorite->plate_id = $plate->id;
			$favorite->user_id =  APIActiveController::getApiUser()->id;

			if ($favorite->save())
			{
				\Yii::$app->getResponse()->setStatusCode(200);
				return ApiResponse::success($favorite);
			}
			else
			{
				return ApiResponse::error([$favorite->errors]);
			}
		}
		else
		{
			\Yii::$app->getResponse()->setStatusCode(403);
			return ApiResponse::error(['O cliente já tem este favorito!']);
		}
	}

	public function actionRemovefavorite($id)
	{
		$plate = $this->findModel($id);

		$favorite = Favorite::find()->select(['*'])
			->where(['user_id' => APIActiveController::getApiUser()->id])
			->andWhere(['plate_id' => $plate->id])
			->one();

		if ($favorite != null)
		{
			$favorite->delete();

			\Yii::$app->getResponse()->setStatusCode(204); // No Content
			return null;
		}
		else
		{
			throw new NotFoundHttpException('Favorito para apagar, não encontrado!');
		}
	}

	protected function findModel($id)
	{
		$model = Plate::find()->select(['*'])->where(['id' => $id])->one();

		if ($model === null)
		{
			throw new NotFoundHttpException('Model not found.');
		}

		return $model;
	}
}
