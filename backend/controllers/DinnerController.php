<?php

namespace backend\controllers;

use app\models\Dinner;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DinnerController implements the CRUD actions for Dinner model.
 */
class DinnerController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Dinner models.
     *
     * @return string
     */
    public function actionIndex($cleaned = true)
    {
        $query = null;

        if ($cleaned)
        {
            $query = Dinner::find()->where(['isClean' => 1]);
        }
        else
        {
            $query = Dinner::find()->where(['isClean' => 0]);
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'cleaned' => $cleaned,
        ]);
    }

    /**
     * Displays a single Dinner model.
     * @param int $id id da mesa
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
     * Creates a new Dinner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Dinner();

        if ($this->request->isPost)
        {
            if ($model->load($this->request->post()) && $model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        else
        {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Dinner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id id da mesa
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save())
        {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Dinner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id id da mesa
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCleaned($id)
    {
        $model = $this->findModel($id);

        if ($model)
        {
            if ($model->isClean == 0)
            {
                $model->isClean = 1;
            }
            else
            {
                $model->isClean = 0;
            }

            if ($model->save())
            {
                \Yii::$app->session->setFlash('success', 'O estado foi modificado!');
            }
            else
            {
                \Yii::$app->session->setFlash('error', 'Não foi possível realizar a atualização de estado!');
            }
        }
        else
        {
            \Yii::$app->session->setFlash('error', 'A Mesa não existe!');
        }

        return $this->redirect(['index']); // Redirect to the index action or another appropriate page
    }

    /**
     * Finds the Dinner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id id da mesa
     * @return Dinner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dinner::findOne(['id' => $id])) !== null)
        {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
