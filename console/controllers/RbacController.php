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
    public static $RoleAdmin = "admin";
    public static $RoleWaiter = "waiter";
    public static $RoleCooker = "cooker";
    public static $RoleClient = "client";

    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        //region Permissions

        //Permission - Gerir Prato
        $permission_managePlate = $auth->createPermission('managePlate');
        //$permission_managePlate->description = 'Gere um Prato';
        $auth->add($permission_managePlate);

        //Permission - Gerir Pedidos
        $permission_manageRequest = $auth->createPermission('manageRequest');
        $permission_manageRequest->description = 'Gere um Pedido de um Prato';
        $auth->add($permission_manageRequest);

        //Permission - Gerir Faturas
        $permission_manageInvoice = $auth->createPermission('manageInvoice');
        $permission_manageInvoice->description = 'Gere uma Fatura';
        $auth->add($permission_manageInvoice);

        //Permission - Realizar um pedido de ajuda
        $permission_manageHelpTicket = $auth->createPermission('manageHelpTicket');
        $permission_manageHelpTicket->description = 'Pedido de ajuda do cliente';
        $auth->add($permission_manageHelpTicket);

        //Permission - Gerir Favoritos
        $permission_manageFavorite = $auth->createPermission('manageFavorite');
        $permission_manageFavorite->description = 'Pratos favoritos do Cliente';
        $auth->add($permission_manageFavorite);

        //Permission - Gerir Mesa
        $permission_manageDinner = $auth->createPermission('manageDinner');
        $permission_manageDinner->description = 'Mesa que o cliente irá se sentar';
        $auth->add($permission_manageDinner);

        //endregion Permissions

        //region Roles  

        //Role - Cliente
        $client = $auth->createRole(RbacController::$RoleClient);
        $auth->addChild($client, $permission_manageFavorite);
        $auth->addChild($client, $permission_manageHelpTicket);
        $auth->addChild($client, $permission_manageInvoice);
        $auth->addChild($client, $permission_manageRequest);
        $auth->add($client);

        //Role - Garçon
        $waiter = $auth->createRole(RbacController::$RoleWaiter);
        $auth->addChild($waiter, $permission_manageDinner);
        $auth->addChild($waiter, $permission_manageInvoice);
        $auth->addChild($waiter, $permission_manageRequest);
        $auth->add($waiter);

        //Role - Cozinheiro
        $cooker = $auth->createRole(RbacController::$RoleCooker);
        $auth->add($cooker);
        $auth->addChild($cooker, $permission_managePlate);
        $auth->addChild($cooker, $permission_manageRequest);

        //Role - Admin
        $admin = $auth->createRole(RbacController::$RoleAdmin);
        $auth->add($admin);
        $auth->addChild($admin, $cooker);
        $auth->addChild($admin, $waiter);
        $auth->addChild($admin, $client);

        //endregion Roles

        // Adiciona os Roles aos Utilizadores pré-definidos na BD
        $auth->assign($admin, 1);
        $auth->assign($cooker, 2);
        $auth->assign($waiter, 3);
        $auth->assign($client, 4);
    }
}