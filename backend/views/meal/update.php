<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Meal $model */

$this->title = 'Atualizar Refeição: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Refeições', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="meal-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>