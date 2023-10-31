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
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    //Esta linha foi comentada porque o redirect feito no login caso o cliente não tenha permissões não era POST.
                    //'logout' => ['post'],
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
                'class' => \yii\web\ErrorAction::class,
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
        $userRole = null;
        $arrayAuthRoleItems = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        if (count($arrayAuthRoleItems) > 0) {
            $userRole = array_values($arrayAuthRoleItems)[0]->description;
        }

        return $this->render('index', [
            'userRole' => $userRole
        ]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $userID = $this->user->id;

            if (
                Yii::$app->authManager->getAssignment(RbacController::$RoleAdmin, $userID) ||
                Yii::$app->authManager->getAssignment(RbacController::$RoleCooker, $userID) ||
                Yii::$app->authManager->getAssignment(RbacController::$RoleWaiter, $userID)
            ) {
                return $this->goBack();
            } else {
                return $this->redirect('logout');
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

        return $this->goHome();
    }
}
