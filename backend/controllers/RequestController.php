<?php

namespace backend\controllers;

use app\models\Request;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use console\controllers\RbacController;
use yii\filters\AccessControl;
use common\components\Mosquitto;
use common\models\Plate;

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
        $query = Request::find()->joinWith('meal')->where(['checkout' => 0]);

        if (\Yii::$app->user->can(RbacController::$RoleCooker))
        {
            $query->where(['isCooked' => 0]);
        }
        else if (\Yii::$app->user->can(RbacController::$RoleWaiter))
        {
            $query->where(['isCooked' => 1])->andWhere(['isDelivered' => 0]);
        }
        else
        {
            $query->all();
        }

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'fullList' => \Yii::$app->user->can(RbacController::$RoleAdmin),
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

        return $this->render('view', [
            'model' => $model,
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
            if ($model->load($this->request->post()))
            {
                $plate = Plate::findOne($model->plate_id);
                $model->price = $plate->price;

                if ($model->save())
                {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
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

        if ($this->request->isPost && $model->load($this->request->post()))
        {
            // Check if the user is an admin and is updating isDelivered
            if (\Yii::$app->user->can(RbacController::$RoleAdmin) && $model->isAttributeChanged('isDelivered'))
            {
                // If admin tries to set isDelivered to 1 and isCooked is 0, prevent the update
                if ($model->isDelivered == 1 && $model->isCooked == 0)
                {
                    // Redirect or show an error message indicating the issue
                    \Yii::$app->session->setFlash('error', 'O pedido não pode ser entregue se não tiver cozinhado!');
                    return $this->redirect(['/request']);
                }
            }

            // Proceed with the update
            if ($model->save())
            {
                return $this->redirect(['/request']);
            }
        }

        return $this->render('update', ['model' => $model,]);
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
            if ($model->isCooked == 1)
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
                \Yii::$app->session->setFlash('error', 'O Pedido ainda não está cozinhado!');
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
