<?php


namespace backend\tests\Functional;

use app\models\Request;
use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use common\models\User;
use console\controllers\RbacController;

class RequestFilterTestCest
{

    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }
    public function _before(FunctionalTester $I)
    {
        $user = User::find()->where(['id' => 2])->one();

        $auth = \Yii::$app->authManager;
        $role = $auth->getRole(RbacController::$RoleCooker);
        $auth->assign($role,  $user->id);

        $user = User::find()->where(['id' => 3])->one();

        $auth = \Yii::$app->authManager;
        $role = $auth->getRole(RbacController::$RoleWaiter);
        $auth->assign($role,  $user->id);

        $I->amOnRoute('site/login');
    }

    // tests
    public function WaiterSeesCookedRequestsTest(FunctionalTester $I)
    {

        // Assume que ja existem requests na base de dados
        $cookedRequests = Request::find()->where(['isCooked' => 1])->andWhere(['isDelivered' => 0])->all();

        $waiter = User::findOne(['username' => 'waiter']); // Fetch waiter user

        // Authenticate as the waiter
        $I->amLoggedInAs($waiter);

        // Visit the request index page
        $I->amOnPage('/request/index');

        // Verify that the page displays cooked requests
        foreach ($cookedRequests as $cookedRequest)
        {
            $I->see($cookedRequest->id); // Assuming description field represents the request
        }
    }

    public function CookerSeesUncookedRequestsTest(FunctionalTester $I)
    {

        // Assume que ja existem requests na base de dados
        $notCookedRequests = Request::find()->where(['isCooked' => 0])->all();

        $cooker = User::findOne(['username' => 'cooker']); // Fetch waiter user

        // Authenticate as the cooker
        $I->amLoggedInAs($cooker);

        // Visit the request index page
        $I->amOnPage('/request/index');

        // Verify that the page displays cooked requests
        foreach ($notCookedRequests as $notCookedRequest)
        {
            $I->see($notCookedRequest->id); // Assuming description field represents the request
        }
    }
}
