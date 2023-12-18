<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use console\controllers\RbacController;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\users\User $user */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $userID =  Yii::$app->user->getId();

    if (Yii::$app->authManager->getAssignment(RbacController::$RoleAdmin, $userID))
    {
        echo $form->field($user, 'status')->textInput();
    } ?>

    <?= $form->field($user, 'username')->textInput(['autofocus' => true]) ?>
    <?= $form->field($user, 'email') ?>

    <?= $form->field($userInfo, 'name') ?>
    <?= $form->field($userInfo, 'surname') ?>
    <?= $form->field($userInfo, 'nif') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>