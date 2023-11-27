<?php

namespace backend\controllers;

use app\models\Meal;
use app\models\MealSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use console\controllers\RbacController;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

/**
 * MealController implements the CRUD actions for Meal model.
 */
class MealController extends Controller
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
                //ACF
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => [RbacController::$RoleAdmin, RbacController::$RoleWaiter],
                        ],
                    ],
                    'denyCallback' => function ()
                    {
                        echo $this->render('@app/views/site/error', [
                            'name' => 'Erro na autenticação',
                            'message' => 'Apenas utilizadores autorizados podem se autenticar no backend!'
                        ]);

                        die;
                    },
                ],
            ]
        );
    }

    /**
     * Lists all Meal models.
     *
     * @return string
     */
    public function actionIndex($checkout = false)
    {
        $query = null;

        if ($checkout)
        {
            $query = Meal::find()->where(['checkout' => 1]);
        }
        else
        {
            $query = Meal::find()->where(['checkout' => 0]);
        }

        $searchModel = new MealSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, $query);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'checkout' => $checkout,
        ]);
    }

    /**
     * Displays a single Meal model.
     * @param int $id id da refeição
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $meal =  $this->findModel($id);

        $platesDataProvider = new ActiveDataProvider([
            'query' => $meal->getRequests(),
        ]);

        return $this->render('view', [
            'model' => $meal,
            'platesDataProvider' => $platesDataProvider,
        ]);
    }

    /**
     * Creates a new Meal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Meal();

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
     * Updates an existing Meal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id id da refeição
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
     * Deletes an existing Meal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id id da refeição
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Meal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id id da refeição
     * @return Meal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Meal::findOne(['id' => $id])) !== null)
        {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
