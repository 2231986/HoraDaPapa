<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Meal $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="meal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dinner_table_id')->textInput() ?>

    <?= $form->field($model, 'checkout')->textInput() ?>

    <?= $form->field($model, 'date_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
