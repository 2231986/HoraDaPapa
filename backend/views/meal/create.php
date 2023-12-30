<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Meal $model */

$this->title = 'Criar Refeição';
$this->params['breadcrumbs'][] = ['label' => 'Meals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meal-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>