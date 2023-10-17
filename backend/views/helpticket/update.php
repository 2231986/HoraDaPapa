<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Helpticket $model */

$this->title = 'Update Helpticket: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Helptickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="helpticket-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
