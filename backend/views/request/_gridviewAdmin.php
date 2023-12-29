<?php

use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;

use yii\grid\GridView;

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'meal_id',
        'observation',
        'plate.title',
        'quantity',
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            },
        ],
    ],
]); ?>