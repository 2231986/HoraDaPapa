<?php

use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use console\controllers\RbacController;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\User $user */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $userID =  Yii::$app->user->getId();

    if (Yii::$app->authManager->getAssignment(RbacController::$RoleAdmin, $userID))
    {
        $statusOptions = [
            User::STATUS_ACTIVE =>  'Ativo',
            User::STATUS_INACTIVE => 'Inativo',
            User::STATUS_DELETED => 'Apagado',
        ];

        echo $form->field($user, 'status')->dropDownList($statusOptions, ['class' => 'form-control']);
    } ?>

    <?= $form->field($user, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($user, 'email') ?>

    <?php


    if (isset($userRole)) //update
    {
        $defaulSelected = $userRole->name;
    }
    else //create
    {
        $defaulSelected = RbacController::$RoleClient;
    }

    echo $form->field($user, 'role')->dropDownList(
        ArrayHelper::map($userRoles, 'name', 'description'),
        [
            'value' => $defaulSelected,
        ]
    );
    ?>

    <?= isset($userInfo) ? $form->field($userInfo, 'name')->textInput() : '' ?>

    <?= isset($userInfo) ? $form->field($userInfo, 'surname')->textInput() : '' ?>

    <?= isset($userInfo) ? $form->field($userInfo, 'nif')->textInput() : '' ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>