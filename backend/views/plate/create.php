<?php

use yii\helpers\Html;
use app\models\Supplier;

/** @var yii\web\View $this */
/** @var common\models\Plate $plate */

$this->title = 'Criar Prato';
$this->params['breadcrumbs'][] = ['label' => 'Pratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plate-create">

    <?= $this->render('_form', [
        'plate' => $plate,
        'supplier' => $supplier,
        'uploadForm' => $uploadForm,
    ]) ?>

</div>