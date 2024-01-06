<?php

use console\controllers\RbacController;
use yii\helpers\Url;

$user =  Yii::$app->user->getIdentity();
if ($user == null) //Martelada para não rebentar quando entra na sidebar sem login!
{
    return;
}

$menuItems = [];

#region MenuItems com permissões

$userID = $user->id;
$userProfileLink;

if (Yii::$app->user->can(RbacController::$PermissionUser))
{
    if (Yii::$app->authManager->getAssignment(RbacController::$RoleAdmin, $userID))
    {
        $userProfileLink = "/user";
        $menuItems[] = [
            'label' => 'Utilizadores', 'url' => [$userProfileLink], 'icon' => 'fa-regular fa-user',
            'items' => [ // Submenu items array
                [
                    'label' => 'Index',
                    'url' => Url::to(['user/']),
                    'icon' => 'fa-solid fa-list',
                ],
                [
                    'label' => 'Criar',
                    'url' => Url::to(['/user/create']),
                    'icon' => 'fa-solid fa-plus',

                ],
            ]
        ];
    }
    else
    {
        $userProfileLink = "/user/update?id=$userID";
        array_push($menuItems, ['label' => 'Utilizador', 'url' => [$userProfileLink]]);
    }
}

if (Yii::$app->user->can(RbacController::$PermissionPlate))
{
    $menuItems[] = [
        'label' => 'Pratos', 'icon' => 'fa-solid fa-utensils',
        'id' => 'pratos-index',
        'items' => [ // Submenu items array
            [
                'label' => 'Index',
                'url' => Url::to(['/plate']),
                'icon' => 'fa-solid fa-list',
            ],
            [
                'label' => 'Criar',
                'url' => Url::to(['/plate/create']),
                'icon' => 'fa-solid fa-plus',

            ],
        ]
    ];
}

if (Yii::$app->user->can(RbacController::$PermissionRequest))
{
    $menuItems[] = ['label' => 'Pedidos', 'url' => ['/request/index'], 'icon' => 'fas fa-list'];
}

if (Yii::$app->user->can(RbacController::$PermissionDinner))
{
    $menuItems[] = [
        'label' => 'Mesas', 'icon' => 'fas fa-table',
        'items' => [ // Submenu items array
            [
                'label' => 'Index',
                'url' => Url::to(['dinner/index']),
                'icon' => 'fa-solid fa-list',
            ],
            [
                'label' => 'Criar',
                'url' => Url::to(['dinner/create']),
                'icon' => 'fa-solid fa-plus',

            ],
            [
                'label' => 'Mesas por Limpar',
                'url' => Url::to(['/dinner', 'cleaned' => 0]),
                'icon' => 'fa-solid fa-plus',

            ],
            [
                'label' => 'Mesas Limpas',
                'url' => Url::to(['/dinner', 'cleaned' => 1]),
                'icon' => 'fa-solid fa-plus',

            ]
        ]
    ];
}

if (Yii::$app->user->can(RbacController::$PermissionHelpticket))
{
    $menuItems[] = [
        'label' => 'Pedidos de Ajuda', 'icon' => 'fas fa-hand-paper',
        'items' => [ // Submenu items array
            [
                'label' => 'Index',
                'url' => Url::to(['helpticket/index']),
                'icon' => 'fa-solid fa-list',
            ],
            [
                'label' => 'Por Resolver',
                'url' => Url::to(['/helpticket', 'resolved' => 0]),
                'icon' => 'fa-solid fa-plus',

            ],
            [
                'label' => 'Resolvidos',
                'url' => Url::to(['/helpticket', 'resolved' => 1]),
                'icon' => 'fa-solid fa-plus',

            ]
        ]
    ];
}

if (Yii::$app->user->can(RbacController::$PermissionInvoice))
{
    $menuItems[] = [
        'label' => 'Faturas', 'icon' => 'fa-solid fa-receipt',
        'items' => [ // Submenu items array
            [
                'label' => 'Index',
                'url' => Url::to(['invoice/index']),
                'icon' => 'fa-solid fa-list',
            ],
            [
                'label' => 'Criar',
                'url' => Url::to(['/invoice/create']),
                'icon' => 'fa-solid fa-plus',

            ],
        ]
    ];
}

if (Yii::$app->user->can(RbacController::$PermissionSupplier))
{
    $menuItems[] = [
        'label' => 'Fornecedores', 'icon' => 'fa-solid fa-truck',
        'items' => [ // Submenu items array
            [
                'label' => 'Index',
                'url' => Url::to(['supplier/index']),
                'icon' => 'fa-solid fa-list',
            ],
            [
                'label' => 'Criar',
                'url' => Url::to(['/supplier/create']),
                'icon' => 'fa-solid fa-plus',

            ],
        ]
    ];
}

if (Yii::$app->user->can(RbacController::$PermissionReview))
{
    $menuItems[] = ['label' => 'Avaliações', 'url' => ['/review/index'], 'icon' => 'fa-solid fa-star'];
}

if (Yii::$app->user->can(RbacController::$PermissionMeal))
{
    $menuItems[] = [
        'label' => 'Refeições', 'icon' => 'fas fa-drumstick-bite',
        'items' => [ // Submenu items array
            [
                'label' => 'Index',
                'url' => Url::to(['meal/index']),
                'icon' => 'fa-solid fa-list',
            ],
            [
                'label' => 'Criar',
                'url' => Url::to(['/meal/create']),
                'icon' => 'fa-solid fa-plus',

            ],
            [
                'label' => 'Refeições Abertas',
                'url' => Url::to(['/meal', 'checkout' => 0]),
                'icon' => 'fas fa-folder-open',

            ],
            [
                'label' => 'Refeicoes Fechadas',
                'url' => Url::to(['/meal', 'checkout' => 1]),
                'icon' => 'fas fa-folder',

            ],
        ]
    ];
}

#endregion MenuItems com permissões

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Url::toRoute(['site/index']) ?>" class="brand-link">
        <img src="<?= Yii::getAlias('@web/images/logo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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