<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Meal $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="meal-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'dinner_table_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\app\models\Dinner::find()->where(['isClean' => 1])->all(), 'id', 'name'),
        ['prompt' => 'Escolha uma mesa']
    ) ?>


    <?= $form->field($model, 'checkout')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>