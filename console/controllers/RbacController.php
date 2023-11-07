<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

//Guia - https://www.yiiframework.com/doc/guide/2.0/en/security-authorization#rbac
//Arranque: 
//php yii migrate --migrationPath=@yii/rbac/migrations
//php yii rbac/init
class RbacController extends Controller
{
    //Roles - names
    public static $RoleAdmin = "admin";
    public static $RoleWaiter = "waiter";
    public static $RoleCooker = "cooker";
    public static $RoleClient = "client";

    //Permissions - names
    public static $PermissionPlate = "managePlate";
    public static $PermissionRequest = "manageRequest";
    public static $PermissionInvoice = "manageInvoice";
    public static $PermissionHelpticket = "manageHelpticket";
    public static $PermissionFavorite = "manageFavorite";
    public static $PermissionDinner = "manageDinner";
    public static $PermissionUser = "manageUser";
    public static $PermissionSupplier = "manageSupplier";

    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        //region Permissions

        //Permission - Gerir Prato
        $permission_managePlate = $auth->createPermission(RbacController::$PermissionPlate);
        $permission_managePlate->description = 'Gere um Prato';
        $auth->add($permission_managePlate);

        //Permission - Gerir Pedidos
        $permission_manageRequest = $auth->createPermission(RbacController::$PermissionRequest);
        $permission_manageRequest->description = 'Gere um Pedido de um Prato';
        $auth->add($permission_manageRequest);

        //Permission - Gerir Faturas
        $permission_manageInvoice = $auth->createPermission(RbacController::$PermissionInvoice);
        $permission_manageInvoice->description = 'Gere uma Fatura';
        $auth->add($permission_manageInvoice);

        //Permission - Realizar um pedido de ajuda
        $permission_manageHelpticket = $auth->createPermission(RbacController::$PermissionHelpticket);
        $permission_manageHelpticket->description = 'Pedido de ajuda do cliente';
        $auth->add($permission_manageHelpticket);

        //Permission - Gerir Favoritos
        $permission_manageFavorite = $auth->createPermission(RbacController::$PermissionFavorite);
        $permission_manageFavorite->description = 'Pratos favoritos do Cliente';
        $auth->add($permission_manageFavorite);

        //Permission - Gerir Mesa
        $permission_manageDinner = $auth->createPermission(RbacController::$PermissionDinner);
        $permission_manageDinner->description = 'Mesa que o cliente irá se sentar';
        $auth->add($permission_manageDinner);

        //Permission - Gerir Utilizadores
        $permission_manageUser = $auth->createPermission(RbacController::$PermissionUser);
        $permission_manageUser->description = 'Gere todos os utilizadores';
        $auth->add($permission_manageUser);

        //Permission - Gerir Fornecedores
        $permission_manageSupplier = $auth->createPermission(RbacController::$PermissionSupplier);
        $permission_manageSupplier->description = 'Gere todos os fornecedores';
        $auth->add($permission_manageSupplier);

        //endregion Permissions

        //region Roles  

        //Role - Cliente
        $client = $auth->createRole(RbacController::$RoleClient);
        $client->description = 'Cliente';
        $auth->add($client);

        $auth->addChild($client, $permission_manageFavorite);
        $auth->addChild($client, $permission_manageHelpticket);
        $auth->addChild($client, $permission_manageInvoice);
        $auth->addChild($client, $permission_manageRequest);

        //Role - Garçon
        $waiter = $auth->createRole(RbacController::$RoleWaiter);
        $waiter->description = 'Garçon';
        $auth->add($waiter);

        $auth->addChild($waiter, $permission_manageDinner);
        $auth->addChild($waiter, $permission_manageInvoice);
        $auth->addChild($waiter, $permission_manageRequest);

        //Role - Cozinheiro
        $cooker = $auth->createRole(RbacController::$RoleCooker);
        $cooker->description = 'Cozinheiro';
        $auth->add($cooker);

        $auth->addChild($cooker, $permission_managePlate);
        $auth->addChild($cooker, $permission_manageRequest);

        //Role - Admin
        $admin = $auth->createRole(RbacController::$RoleAdmin);
        $admin->description = 'Administrador';
        $auth->add($admin);

        $auth->addChild($admin, $cooker);
        $auth->addChild($admin, $waiter);
        $auth->addChild($admin, $client);
        $auth->addChild($admin, $permission_manageUser);
        $auth->addChild($admin, $permission_manageSupplier);

        //endregion Roles

        // Adiciona os Roles aos Utilizadores pré-definidos na BD
        $auth->assign($admin, 1);
        $auth->assign($cooker, 2);
        $auth->assign($waiter, 3);
        $auth->assign($client, 4);
    }
}
