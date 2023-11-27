<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Plate $plate */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="plate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($plate, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($plate, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($plate, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($plate, 'image_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($plate, 'supplier_id')->dropDownList($supplier, ['prompt' => 'Select Supplier']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>