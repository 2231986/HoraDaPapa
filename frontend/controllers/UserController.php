<?php

namespace frontend\controllers;

use Yii;
use yii\web\ForbiddenHttpException;
use console\controllers\RbacController;
use common\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
                            'actions' => ['view', 'update'],
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
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $userID = Yii::$app->user->getId();

        if (!Yii::$app->authManager->getAssignment(RbacController::$RoleAdmin, $userID))
        {
            //Protege contra a visualização de outros utilizadores que não o próprio
            if ($userID != $id)
            {
                throw new ForbiddenHttpException();
            }
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();

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
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $userID = Yii::$app->user->getId();

        if (!Yii::$app->authManager->getAssignment(RbacController::$RoleAdmin, $userID))
        {
            //Protege contra a edição de outros utilizadores que não o próprio
            if ($userID != $id)
            {
                throw new ForbiddenHttpException();
            }
        }

        $user = $this->findModel($id);
        $userInfo =  $user->getUserInfo();

        $post = $this->request->post();

        if (
            $this->request->isPost &&
            $user->load($post) && $user->save() &&
            $userInfo->load($post) && $userInfo->save()
        )
        {
            return $this->redirect(['view', 'id' => $user->id]);
        }

        return $this->render('update', [
            'user' => $user,
            'userInfo' =>  $userInfo,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null)
        {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
