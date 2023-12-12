<?php

namespace backend\controllers;

use app\models\Supplier;
use common\models\Plate;
use common\models\PlateSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use console\controllers\RbacController;
use yii\filters\AccessControl;
use common\components\Mosquitto;

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
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ], //ACF
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => [RbacController::$RoleAdmin, RbacController::$RoleCooker],
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
     * Creates a new Plate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $plate = new Plate();

        if ($this->request->isPost)
        {
            if ($plate->load($this->request->post()) && $plate->save())
            {
                return $this->redirect(['view', 'id' => $plate->id]);
            }
        }
        else
        {
            $plate->loadDefaultValues();
        }

        return $this->render('create', [
            'plate' => $plate,
            'supplier' => Supplier::find()->select(['name'])->indexBy('id')->column(),
        ]);
    }

    /**
     * Updates an existing Plate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id id do prato
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $plate = $this->findModel($id);

        if ($this->request->isPost && $plate->load($this->request->post()) && $plate->save())
        {
            $this->alertClients($plate);

            return $this->redirect(['view', 'id' => $plate->id]);
        }

        return $this->render('update', [
            'plate' => $plate,
            'supplier' => Supplier::find()->select(['name'])->indexBy('id')->column(),
        ]);
    }

    /**
     * Deletes an existing Plate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id id do prato
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
        if (($plate = Plate::findOne(['id' => $id])) !== null)
        {
            return $plate;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function alertClients($plate)
    {
        $favorites = $plate->getFavorites()->all();

        if ($favorites != null)
        {
            foreach ($favorites as $key => $value)
            {
                \Yii::$app->Mosquitto->publish(Mosquitto::getTopic($value->user_id), "O $plate->title foi atualizado!");
            }
        }
    }
}
