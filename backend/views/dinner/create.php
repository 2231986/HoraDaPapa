<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Dinner $model */

$this->title = 'Create Dinner';
$this->params['breadcrumbs'][] = ['label' => 'Dinners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dinner-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
