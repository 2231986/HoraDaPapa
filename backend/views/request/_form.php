<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Request $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'quantity')->textInput(['type' => 'number', 'min' => 1]) ?>

    <?= $form->field($model, 'isCooked')->dropDownList([0 => 'Não', 1 => 'Sim'], ['prompt' => 'Selecione']) ?>

    <?= $form->field($model, 'isDelivered')->dropDownList([0 => 'Não', 1 => 'Sim'], ['prompt' => 'Selecione']) ?>

    <?= $form->field($model, 'observation')->textarea(['rows' => 4, 'placeholder' => 'Insira alguma observação, se necessário']) ?>

    <?= $form->field($model, 'user_id')->label('Cliente')->dropDownList(
        ArrayHelper::map(User::find()->all(), 'id', 'username'),
        ['prompt' => 'Selecione o Cliente']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>