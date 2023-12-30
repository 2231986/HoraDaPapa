<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Request $model */

$this->title = 'Update Request: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="request-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>