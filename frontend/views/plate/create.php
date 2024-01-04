<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Plate $model */

$this->title = 'Criar Prato';
$this->params['breadcrumbs'][] = ['label' => 'Pratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>