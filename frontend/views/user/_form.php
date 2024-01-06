<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use console\controllers\RbacController;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\users\User $user */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="user-form">

                <?php $form = ActiveForm::begin(); ?>

                <?php
                $userID = Yii::$app->user->getId();
                if (Yii::$app->authManager->getAssignment(RbacController::$RoleAdmin, $userID)) {
                    echo $form->field($user, 'status')->textInput();
                } ?>

                <?= $form->field($user, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($user, 'email') ?>

                <?php if ($userInfo !== null) : ?>
                    <?= $form->field($userInfo, 'name') ?>
                    <?= $form->field($userInfo, 'surname') ?>
                    <?= $form->field($userInfo, 'nif') ?>
                <?php endif; ?>

                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
