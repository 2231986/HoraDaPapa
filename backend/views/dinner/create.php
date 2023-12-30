<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Dinner $model */

$this->title = 'Criar Mesa';
$this->params['breadcrumbs'][] = ['label' => 'Dinners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dinner-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>