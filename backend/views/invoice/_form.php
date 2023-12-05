<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Invoice $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="invoice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'meal_id')->dropDownList(
        ArrayHelper::map($meals, 'id', 'dinner.name'),
        ['prompt' => 'Selecionar Refeição']
    ) ?>

    <?= $form->field($model, 'user_id')->dropDownList(
        ArrayHelper::map($users, 'id', 'username'),
        ['prompt' => 'Selecionar Cliente']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>