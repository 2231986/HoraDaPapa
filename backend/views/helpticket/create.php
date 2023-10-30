<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\HelpTicket $model */

$this->title = 'Create Help Ticket';
$this->params['breadcrumbs'][] = ['label' => 'Help Tickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="help-ticket-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
