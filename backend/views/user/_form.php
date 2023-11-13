<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use console\controllers\RbacController;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $userID =  Yii::$app->user->getId();

    if (Yii::$app->authManager->getAssignment(RbacController::$RoleAdmin, $userID))
    {
        echo $form->field($model, 'status')->textInput();
    } ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <?php


    if (isset($userRole)) //update
    {
        $defaulSelected = $userRole->name;
    }
    else //create
    {
        $defaulSelected = RbacController::$RoleAdmin;
    }

    echo $form->field($model, 'role')->dropDownList(
        ArrayHelper::map($userRoles, 'name', 'description'),
        [
            'value' => $defaulSelected,
        ]
    );
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>