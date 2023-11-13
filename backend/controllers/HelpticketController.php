<?php

namespace backend\controllers;

use app\models\Helpticket;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use console\controllers\RbacController;
use yii\filters\AccessControl;

/**
 * HelpticketController implements the CRUD actions for Helpticket model.
 */
class HelpticketController extends Controller
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
     * Lists all Helpticket models.
     *
     * @return string
     */
    public function actionIndex($resolved = false)
    {
        $query = null;

        if ($resolved)
        {
            $query = Helpticket::find()->where(['needHelp' => 0]);
        }
        else
        {
            $query = Helpticket::find()->where(['needHelp' => 1]);
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'resolved' => $resolved,
        ]);
    }

    /**
     * Displays a single Helpticket model.
     * @param int $id id do ticket
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
     * Deletes an existing Helpticket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id id do ticket
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionResolved($id)
    {
        $model = $this->findModel($id);

        if ($model)
        {
            if ($model->needHelp == 1)
            {
                $model->needHelp = 0;
            }
            else
            {
                $model->needHelp = 1;
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
            \Yii::$app->session->setFlash('error', 'O Pedido de Ajuda não existe!');
        }

        return $this->redirect(['index']); // Redirect to the index action or another appropriate page
    }



    /**
     * Finds the Helpticket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id id do ticket
     * @return Helpticket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Helpticket::findOne(['id' => $id])) !== null)
        {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
