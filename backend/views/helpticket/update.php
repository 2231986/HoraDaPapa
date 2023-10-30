<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\HelpTicket $model */

$this->title = 'Update Help Ticket: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Help Tickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="help-ticket-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
