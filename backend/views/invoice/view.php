<?php

use common\helpers\FormatterHelper;
use yii\widgets\DetailView;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Invoice $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="invoice-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'price',
                'label' => 'Total',
                'value' => function ($model)
                {
                    return FormatterHelper::formatCurrency($model->price);
                },
            ],
            'date_time',
            'nif',
            [
                'label' => 'Nome da mesa',
                'attribute' => 'meal.dinner.name',
            ],
            [
                'label' => 'Requests',
                'format' => 'html',
                'value' => function ($model)
                {
                    return GridView::widget([
                        'dataProvider' => new \yii\data\ArrayDataProvider([
                            'allModels' => $model->meal->requests,
                        ]),
                        'columns' => [
                            'plate.title',
                            [
                                'attribute' => 'price',
                                'label' => 'Preço',
                                'value' => function ($model)
                                {
                                    return FormatterHelper::formatCurrency($model->price);
                                },
                            ],
                            'observation',
                        ],
                    ]);
                },
            ],
        ],
    ]) ?>

</div>