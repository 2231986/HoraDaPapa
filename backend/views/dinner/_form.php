<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Dinner $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="dinner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Nome') ?>

    <?= $form->field($model, 'isClean')->textInput()->dropDownList([1 => 'Limpo', 0 => 'Por Limpar'])->label('Estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>