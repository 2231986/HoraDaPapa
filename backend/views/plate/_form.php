<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Plate $plate */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="plate-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($plate, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($plate, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($plate, 'title')->label('Título')->textInput(['maxlength' => true]) ?>

    <?php if ($plate->image_name) : ?>
        <?= Html::img(Yii::getAlias('@web/uploads/') . $plate->image_name, ['height' => '250px', 'width' => '250px', 'class' => 'img-thumbnail', 'alt' => 'Uploaded Image']) ?>
    <?php endif; ?>

    <?= $form->field($uploadForm, 'imageFile')->fileInput(); ?>

    <?= $form->field($plate, 'supplier_id')->label('Fornecedor')->dropDownList($supplier, ['prompt' => 'Select Supplier']) ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>