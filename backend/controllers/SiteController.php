<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use console\controllers\RbacController;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => [RbacController::$RoleAdmin, RbacController::$RoleCooker, RbacController::$RoleWaiter],
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
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'view' => '@app/views/site/error.php',
                'layout' => '@app/views/layouts/no_layout.php'
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionError()
    {
        throw new \yii\base\Exception('Test error');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
        {
            $userID = $this->user->id;

            if (
                Yii::$app->authManager->getAssignment(RbacController::$RoleAdmin, $userID) ||
                Yii::$app->authManager->getAssignment(RbacController::$RoleCooker, $userID) ||
                Yii::$app->authManager->getAssignment(RbacController::$RoleWaiter, $userID)
            )
            {
                return $this->goBack();
            }
            else
            {
                \Yii::$app->user->logout();
            }
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['site/login']);
    }
}
