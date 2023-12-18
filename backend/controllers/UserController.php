<?php

namespace backend\controllers;

use Yii;
use yii\web\ForbiddenHttpException;
use console\controllers\RbacController;
use common\models\User;
use app\models\UserSearch;
use common\models\UserInfo;
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
                            'roles' => [RbacController::$RoleAdmin, RbacController::$RoleWaiter, RbacController::$RoleCooker],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['index', 'create', 'delete'],
                            'roles' => [RbacController::$RoleAdmin],
                        ]
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

        $user = $this->findModel($id);

        return $this->render('view', [
            'user' => $user,
            'userInfo' =>  $user->getUserInfo(),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $user = new User();
        $userInfo = new UserInfo();

        if ($this->request->isPost)
        {
            $post = $this->request->post();

            $result_userLoad = $user->load($post);
            $user->setPassword("12345678"); //TODO: Eventualmente arranjar uma filosofia diferente para gerar a password
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();
            $result_userSave = $user->save();

            $user->saveRole($post["User"]["role"]);

            $result_userInfoLoad =  $userInfo->load($post);
            $userInfo->user_id = $user->id;
            $result_userInfoSave = $userInfo->save();

            if ($result_userLoad && $result_userSave && $result_userInfoLoad && $result_userInfoSave)
            {
                return $this->redirect(['view', 'id' => $user->id]);
            }
        }
        else
        {
            $user->loadDefaultValues();
        }

        return $this->render('create', [
            'user' => $user,
            'userInfo' => $userInfo,
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
            $userInfo->load($post) && $userInfo->save() &&
            $user->saveRole($post["User"]["role"])
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
        $authManager = \Yii::$app->authManager;
        $authManager->revokeAll($id); // Remover roles

        $userInfo = UserInfo::findOne($id);
        $userInfo->delete(); // Remover UserInfo

        $user = $this->findModel($id);
        $user->delete(); // Remover Info

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
        if (($user = User::findOne(['id' => $id])) !== null)
        {
            return $user;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
