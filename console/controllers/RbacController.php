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
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        //Permissions

        //Permission - Gerir Prato
        $permission_managePlate = $auth->createPermission('managePlate');
        $permission_managePlate->description = 'Gere um Prato';
        $auth->add($permission_managePlate);

        //Roles

        //Role - Admin
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $permission_managePlate);

        //Role - Cozinheiro
        $cooker = $auth->createRole('cooker');
        $auth->add($cooker);
        $auth->addChild($cooker, $permission_managePlate);

        //Role - Garçon
        $waiter = $auth->createRole('waiter');
        $auth->add($waiter);

        //Role - Cliente
        $client = $auth->createRole('client');
        $auth->add($client);

        // Adiciona os Roles aos Utilizadores pré-definidos na BD
        $auth->assign($admin, 1);
        $auth->assign($cooker, 2);
        $auth->assign($waiter, 3);
        $auth->assign($client, 4);
    }
}
