<?php

namespace frontend\controllers;

use common\models\Favorite;
use common\models\FavoriteSearch;
use common\models\Plate;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use console\controllers\RbacController;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * FavoriteController implements the CRUD actions for Favorite model.
 */
class FavoriteController extends Controller
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
                            'roles' => [RbacController::$RoleClient],
                        ],
                    ],
                    'denyCallback' => function ()
                    {
                        echo $this->render('@app/views/site/error', [
                            'name' => 'Erro na autenticação',
                            'message' => 'Apenas clientes podem se autenticar no frontend!'
                        ]);

                        die;
                    },
                ],
            ]
        );
    }

    /**
     * Lists all Favorite models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FavoriteSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        // Filtragem de favoritos baseado no utilizador logado
        $dataProvider->query->andWhere(['user_id' => Yii::$app->user->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Favorite model.
     * @param int $id id do favorito
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
     * Creates a new Favorite model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Favorite();

        if ($this->request->isPost)
        {
            // Passa o ID utilizador logado como referencia
            $model->user_id = Yii::$app->user->id;

            if ($model->load($this->request->post()))
            {
                $existingFavorite = Favorite::findOne(['user_id' => $model->user_id, 'plate_id' => $model->plate_id]);

                if (!$existingFavorite)
                {
                    if ($model->save())
                    {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
                else
                {
                    Yii::$app->session->setFlash('error', 'Este prato já foi adicionado!');
                    return $this->redirect(['index']);
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
     * Updates an existing Favorite model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id id do favorito
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
     * Deletes an existing Favorite model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id id do favorito
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Favorite model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id id do favorito
     * @return Favorite the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Favorite::findOne(['id' => $id])) !== null)
        {
            $userID = Yii::$app->user->getId();

            //Protege contra a visualização de outros favoritos não o próprio
            if ($userID != $model->user_id)
            {
                throw new ForbiddenHttpException('Não pode visualizar registos que não são seus!');
            }

            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
