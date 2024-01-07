<?php

use common\models\Plate;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Review $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="review-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'user_id')->label('Cliente')->dropDownList(
        ArrayHelper::map(User::find()->all(), 'id', 'username'),
        ['prompt' => 'Selecione o Cliente']
    ) ?>

    <?= $form->field($model, 'plate_id')->label('Prato')->dropDownList(
        ArrayHelper::map(Plate::find()->all(), 'id', 'title'),
        ['prompt' => 'Selecione o Prato']
    ) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>