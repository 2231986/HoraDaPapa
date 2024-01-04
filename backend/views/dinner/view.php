<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Dinner $model */

\yii\web\YiiAsset::register($this);
?>

<div class="dinner-view">

    <h1><?= Html::encode($model->name) ?></h1>

    <p>
        <?= Html::a('Mudar estado', ['cleaned', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Remover', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem acerteza que pretende remover este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Nome',
                'attribute' => 'name',
            ],
        ],
    ]) ?>

</div>