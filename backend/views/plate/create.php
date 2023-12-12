<?php

use yii\helpers\Html;
use app\models\Supplier;

/** @var yii\web\View $this */
/** @var common\models\Plate $plate */

$this->title = 'Create Plate';
$this->params['breadcrumbs'][] = ['label' => 'Plates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'plate' => $plate,
        'supplier' => $supplier,
        'uploadForm' => $uploadForm,
    ]) ?>

</div>