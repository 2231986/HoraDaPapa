<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Review $model */

$this->title = 'Update Review: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="review-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>