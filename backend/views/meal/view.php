<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\helpers\FormatterHelper;

/** @var yii\web\View $this */
/** @var app\models\Meal $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Refeições', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="meal-view">

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
            [
                'attribute' => 'dinner_table_id',
                'format' => 'raw',
                'value' => function ($model)
                {
                    if ($model->dinner_table_id !== null)
                    {
                        $tableId = $model->dinner->id;
                        $url = \yii\helpers\Url::to(['dinner/view', 'id' => $tableId]);

                        return Html::a($model->dinner->name, $url);
                    }
                    else
                    {
                        return '--';
                    }
                },
            ],
            [
                'attribute' => 'checkout',
                'format' => 'raw',
                'value' => function ($model)
                {
                    $status = $model->checkout == 1 ? 'Pago' : 'Por pagar';
                    $color = $model->checkout == 1 ? 'green' : 'red';

                    return Html::tag('span', $status, ['style' => 'color:' . $color]);
                },
            ],
            'date_time',
        ],
    ]) ?>


    <!-- Detalhe dos pedidos feitos -->
    <?= GridView::widget([
        'dataProvider' => $platesDataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'format' => 'raw',
                'value' => function ($model)
                {
                    return Html::a($model->id, ['request/view', 'id' => $model->id]);
                },
            ],
            [
                'attribute' => 'observation',
                'value' => function ($model)
                {
                    return $model->observation ?? '--';
                },
            ],
            [
                'attribute' => 'plate_id',
                'label' => 'Prato',
                'format' => 'raw',
                'value' => function ($model)
                {
                    return Html::a($model->plate->title, ['plate/view', 'id' => $model->plate_id]);
                },
            ],
            [
                'attribute' => 'isCooked',
                'format' => 'raw',
                'value' => function ($model)
                {
                    $status = $model->isCooked ? 'Sim' : 'Não';
                    $color = $model->isCooked ? 'green' : 'red';
                    return Html::tag('span', $status, ['style' => 'color:' . $color]);
                },
            ],
            [
                'attribute' => 'isDelivered',
                'format' => 'raw',
                'value' => function ($model)
                {
                    $status = $model->isDelivered ? 'Sim' : 'Não';
                    $color = $model->isDelivered ? 'green' : 'red';
                    return Html::tag('span', $status, ['style' => 'color:' . $color]);
                },
            ],
            [
                'attribute' => 'user_id',
                'label' => 'Cliente',
                'format' => 'raw',
                'value' => function ($model)
                {
                    $username = $model->user ? $model->user->username : '--';
                    return Html::a(Html::tag('span', $username), ['user/view', 'id' => $model->user_id]);
                },
            ],

            'date_time',
            [
                'attribute' => 'price',
                'label' => 'Preço',
                'value' => function ($model)
                {
                    return FormatterHelper::formatCurrency($model->price);
                },
            ],
            'quantity',
        ],
    ]); ?>


</div>