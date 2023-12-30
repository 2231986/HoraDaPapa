<?php

namespace frontend\controllers;

use common\models\Plate;
use common\models\PlateSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

/**
 * PlateController implements the CRUD actions for Plate model.
 */
class PlateController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                //ACF
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['?', '@'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Plate models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PlateSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Plate model.
     * @param int $id id do prato
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Plate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id id do prato
     * @return Plate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Plate::findOne(['id' => $id])) !== null)
        {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
