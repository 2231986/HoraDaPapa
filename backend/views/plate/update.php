<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Plate $model */

$this->title = 'Update Plate: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Plates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="plate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
