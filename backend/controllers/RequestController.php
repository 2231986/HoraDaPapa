<?php

namespace backend\controllers;

use app\models\Request;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use console\controllers\RbacController;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use common\components\Mosquitto;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends Controller
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
                            'roles' => [RbacController::$RoleAdmin, RbacController::$RoleWaiter, RbacController::$RoleCooker],
                        ],
                    ],
                    'denyCallback' => function ()
                    {
                        if (\Yii::$app->user->isGuest)
                        {
                            $this->layout = 'no_layout';
                            echo $this->render('@app/views/site/error', [
                                'name' => 'Erro na autenticação',
                                'message' => 'Apenas utilizadores autorizados podem se autenticar no backend!'
                            ]);
                        }
                        else
                        {
                            echo $this->render('@app/views/site/error', [
                                'name' => 'Erro na autenticação',
                                'message' => 'Apenas utilizadores autorizados podem se autenticar no backend!'
                            ]);
                        }
                        die;
                    },
                ],
            ]
        );
    }

    /**
     * Lists all Request models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Request::find();

        if (\Yii::$app->user->can(RbacController::$RoleCooker)) {
            $query->where(['isCooked' => 0]);
        } elseif (\Yii::$app->user->can(RbacController::$RoleWaiter)) {
            $query->joinWith('meal')
                ->where(['isCooked' => 1])
                ->andWhere(['isDelivered' => 0]);

            $groupedRequests = [];
            foreach ($query->each() as $request) {
                if ($request->meal !== null) {
                    $dinnerTableId = $request->meal->dinner_table_id;
                    $groupedRequests[$dinnerTableId][] = $request;
                }
            }

            $dataProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $groupedRequests,
            ]);
        } else {
            $query->where(['!=', 'isCooked', 1])
                ->orWhere(['!=', 'isDelivered', 1]);
        }

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'groupedRequests' => $groupedRequests ?? null,
        ]);

    }

    /**
     * Displays a single Request model.
     * @param int $id id do pedido
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $groupedRequests =[];

        return $this->render('view', [
            'model' => $model,
            'groupedRequests' => $groupedRequests, // tal como no index, passa groupedRequests para a view, de forma
        ]);
    }

    /**
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Request();

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
     * Updates an existing Request model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id id do pedido
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save())
        {
            return $this->redirect('index');        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id id do pedido
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCooked($id)
    {
        $model = $this->findModel($id);

        if ($model)
        {
            if ($model->isCooked == 0)
            {
                $model->isCooked = 1;
            }
            else
            {
                $model->isCooked = 0;
            }

            if ($model->save())
            {
                \Yii::$app->session->setFlash('success', 'O estado foi modificado para cozinhado!');
                \Yii::$app->Mosquitto->publish(Mosquitto::getTopic($model->user_id), 'O estado foi modificado para cozinhado!');
            }
            else
            {
                \Yii::$app->session->setFlash('error', 'Não foi possível realizar a atualização de estado!');
            }
        }
        else
        {
            \Yii::$app->session->setFlash('error', 'O Pedido não existe!');
        }

        return $this->redirect(['index']); // Redirect to the index action or another appropriate page
    }

    public function actionDelivered($id)
    {
        $model = $this->findModel($id);

        if ($model)
        {
            if ($model->isDelivered == 0)
            {
                $model->isDelivered = 1;
            }
            else
            {
                $model->isDelivered = 0;
            }

            if ($model->save())
            {
                \Yii::$app->session->setFlash('success', 'O estado foi modificado para entregue!');
                \Yii::$app->Mosquitto->publish(Mosquitto::getTopic($model->user_id), 'O estado foi modificado para entregue!');
            }
            else
            {
                \Yii::$app->session->setFlash('error', 'Não foi possível realizar a atualização de estado!');
            }
        }
        else
        {
            \Yii::$app->session->setFlash('error', 'O Pedido não existe!');
        }

        return $this->redirect(['index']); // Redirect to the index action or another appropriate page
    }

    /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id id do pedido
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne(['id' => $id])) !== null)
        {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
