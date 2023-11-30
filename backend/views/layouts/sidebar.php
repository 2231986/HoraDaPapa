<?php

use console\controllers\RbacController;
use yii\helpers\Url;

$user =  Yii::$app->user->getIdentity();

$menuItems = [];

#region MenuItems com permissões

$userID = $user->id;
$userProfileLink;

if (Yii::$app->user->can(RbacController::$PermissionUser))
{
    if (Yii::$app->authManager->getAssignment(RbacController::$RoleAdmin, $userID))
    {
        $userProfileLink = "/user";
        array_push($menuItems, ['label' => 'Utilizadores', 'url' => [$userProfileLink]]);
    }
    else
    {
        $userProfileLink = "/user/update?id=$userID";
        array_push($menuItems, ['label' => 'Utilizador', 'url' => [$userProfileLink]]);
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

if (Yii::$app->user->can(RbacController::$PermissionMeal))
{
    array_push($menuItems, ['label' => 'Refeições', 'url' => ['/meal/index']]);
}

#endregion MenuItems com permissões

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Url::toRoute(['site/index']) ?>" class="brand-link">
        <img src="<?= $assetDir ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Hora da Papa</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= $assetDir ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            </div>
            <div class="info">
                <a href="<?= Url::toRoute($userProfileLink) ?>" class="d-block"> <?= $user->username ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php

            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => $menuItems
            ]);

            // echo \hail812\adminlte\widgets\Menu::widget([
            //     'items' => [
            //         [
            //             'label' => 'Starter Pages',
            //             'icon' => 'tachometer-alt',
            //             'badge' => '<span class="right badge badge-info">2</span>',
            //             'items' => [
            //                 ['label' => 'Active Page', 'url' => ['site/index'], 'iconStyle' => 'far'],
            //                 ['label' => 'Inactive Page', 'iconStyle' => 'far'],
            //             ]
            //         ],
            //         ['label' => 'Simple Link', 'icon' => 'th', 'badge' => '<span class="right badge badge-danger">New</span>'],
            //         ['label' => 'Yii2 PROVIDED', 'header' => true],
            //         ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
            //         ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
            //         ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
            //         ['label' => 'MULTI LEVEL EXAMPLE', 'header' => true],
            //         ['label' => 'Level1'],
            //         [
            //             'label' => 'Level1',
            //             'items' => [
            //                 ['label' => 'Level2', 'iconStyle' => 'far'],
            //                 [
            //                     'label' => 'Level2',
            //                     'iconStyle' => 'far',
            //                     'items' => [
            //                         ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
            //                         ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
            //                         ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle']
            //                     ]
            //                 ],
            //                 ['label' => 'Level2', 'iconStyle' => 'far']
            //             ]
            //         ],
            //         ['label' => 'Level1'],
            //         ['label' => 'LABELS', 'header' => true],
            //         ['label' => 'Important', 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'],
            //         ['label' => 'Warning', 'iconClass' => 'nav-icon far fa-circle text-warning'],
            //         ['label' => 'Informational', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'],
            //     ],
            // ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>