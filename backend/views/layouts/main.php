<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use console\controllers\RbacController;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title>
        <?= Html::encode($this->title) ?>
    </title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
            ],
        ]);

        $userID = Yii::$app->user->getId();

        $menuItems = [];

        #region MenuItems com permissões

        if (Yii::$app->user->can(RbacController::$PermissionUser))
        {
            if (Yii::$app->authManager->getAssignment(RbacController::$RoleAdmin, $userID))
            {
                array_push($menuItems, ['label' => 'Utilizadores', 'url' => ["/user"]]);
            }
            else
            {
                array_push($menuItems, ['label' => 'Utilizador', 'url' => ["/user/update?id=$userID"]]);
            }
        }

        if (Yii::$app->user->can(RbacController::$PermissionPlate))
        {
            array_push($menuItems, ['label' => 'Pratos', 'url' => ['/plate/index']]);
        }

        if (Yii::$app->user->can(RbacController::$PermissionRequest))
        {
            array_push($menuItems, ['label' => 'Pedidos', 'url' => ['/request/index']]);
        }

        if (Yii::$app->user->can(RbacController::$PermissionDinner))
        {
            array_push($menuItems, ['label' => 'Mesas', 'url' => ['/dinner/index']]);
        }

        if (Yii::$app->user->can(RbacController::$PermissionHelpticket))
        {
            array_push($menuItems, ['label' => 'Pedidos de Ajuda', 'url' => ['/helpticket/index']]);
        }

        if (Yii::$app->user->can(RbacController::$PermissionInvoice))
        {
            array_push($menuItems, ['label' => 'Faturas', 'url' => ['/invoice/index']]);
        }

        if (Yii::$app->user->can(RbacController::$PermissionSupplier))
        {
            array_push($menuItems, ['label' => 'Fornecedores', 'url' => ['/supplier/index']]);
        }

        if (Yii::$app->user->can(RbacController::$PermissionReview))
        {
            array_push($menuItems, ['label' => 'Avaliações', 'url' => ['/review/index']]);
        }

        #endregion MenuItems com permissões

        if (Yii::$app->user->isGuest)
        {
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
            'items' => $menuItems,
        ]);

        if (Yii::$app->user->isGuest)
        {
            echo Html::tag('div', Html::a('Login', ['/site/login'], ['class' => ['btn btn-link login text-decoration-none']]), ['class' => ['d-flex']]);
        }
        else
        {
            echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout text-decoration-none']
                )
                . Html::endForm();
        }

        NavBar::end();
        ?>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container">
            <p class="float-start">&copy;
                <?= Html::encode(Yii::$app->name) ?>
                <?= date('Y') ?>
            </p>
            <p class="float-end">
                <?= Yii::powered() ?>
            </p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
