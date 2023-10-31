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

        //Permissions

        //Permission - Gerir Prato
        $permission_managePlate = $auth->createPermission('managePlate');
        //$permission_managePlate->description = 'Gere um Prato';
        $auth->add($permission_managePlate);

        //Roles

        //Role - Admin
        $admin = $auth->createRole(RbacController::$RoleAdmin);
        $auth->add($admin);
        $auth->addChild($admin, $permission_managePlate);

        //Role - Cozinheiro
        $cooker = $auth->createRole(RbacController::$RoleCooker);
        $auth->add($cooker);
        $auth->addChild($cooker, $permission_managePlate);

        //Role - Garçon
        $waiter = $auth->createRole(RbacController::$RoleWaiter);
        $auth->add($waiter);

        //Role - Cliente
        $client = $auth->createRole(RbacController::$RoleClient);
        $auth->add($client);

        // Adiciona os Roles aos Utilizadores pré-definidos na BD
        $auth->assign($admin, 1);
        $auth->assign($cooker, 2);
        $auth->assign($waiter, 3);
        $auth->assign($client, 4);
    }
}
