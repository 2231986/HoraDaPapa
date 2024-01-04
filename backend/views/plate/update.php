<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Plate $plate */

$this->title = 'Atualizar Prato: ' . $plate->title;
$this->params['breadcrumbs'][] = ['label' => 'Pratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $plate->title, 'url' => ['view', 'id' => $plate->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="plate-update">

    <?= $this->render('_form', [
        'plate' => $plate,
        'supplier' => $supplier,
        'uploadForm' => $uploadForm,
    ]) ?>

</div>