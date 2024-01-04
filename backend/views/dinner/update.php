<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Dinner $model */

$this->title = 'Atualizar Mesa: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mesas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="dinner-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>