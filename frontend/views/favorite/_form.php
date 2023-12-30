<?php

use common\models\Plate;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Favorite $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="favorite-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'plate_id')->dropDownList(
        ArrayHelper::map(Plate::find()->all(), 'id', 'title'),
        ['prompt' => 'Selecione o Prato']
    ) ?>








    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>