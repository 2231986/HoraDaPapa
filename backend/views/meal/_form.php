<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Meal $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="meal-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'dinner_table_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\app\models\Dinner::find()
            ->where(['or', ['isClean' => 1], ['id' => $model->dinner_table_id]])
            ->all(), 'id', 'name'),
        [
            'prompt' => 'Escolha uma mesa',
            'options' => [
                $model->dinner_table_id => ['selected' => true]
            ]
        ]
    ) ?>


    <?= $form->field($model, 'checkout')->dropDownList(
        ['0' => 'Por pagar', '1' => 'Pago']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>