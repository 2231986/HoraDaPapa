<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Helpticket $model */

$this->title = 'Create Helpticket';
$this->params['breadcrumbs'][] = ['label' => 'Helptickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="helpticket-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
