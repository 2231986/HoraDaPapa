<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Dinner $model */

$this->title = 'Update Dinner: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Dinners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dinner-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>