<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Plate $plate */

$this->title = 'Update Plate: ' . $plate->title;
$this->params['breadcrumbs'][] = ['label' => 'Plates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $plate->title, 'url' => ['view', 'id' => $plate->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="plate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'plate' => $plate,
        'supplier' => $supplier,
    ]) ?>

</div>