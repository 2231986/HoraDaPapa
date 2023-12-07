<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\RequestSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'meal_id') ?>

    <?= $form->field($model, 'observation') ?>

    <?= $form->field($model, 'plate_id') ?>

    <?= $form->field($model, 'isCooked') ?>

    <?php // echo $form->field($model, 'isDelivered') 
    ?>

    <?php // echo $form->field($model, 'user_id') 
    ?>

    <?php // echo $form->field($model, 'date_time') 
    ?>

    <?php // echo $form->field($model, 'price') 
    ?>

    <?php // echo $form->field($model, 'quantity') 
    ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>