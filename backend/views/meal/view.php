<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Meal $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Meals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="meal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Remover', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

        <?php
        if (!$model->checkout)
        {
            echo Html::a('Criar Fatura', ['invoice', 'id' => $model->id], ['class' => 'btn btn-primary']);
        }
        ?>
    </p>

    <!-- Detalhe da refeição -->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'dinner_table_id',
            'checkout',
            'date_time',
        ],
    ]) ?>

    <!-- Detalhe dos pedidos feitos -->
    <?= GridView::widget([
        'dataProvider' => $platesDataProvider,
    ]); ?>

</div>