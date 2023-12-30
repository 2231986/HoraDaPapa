<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Meal $model */

$this->title = 'Update Meal: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Meals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="meal-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>