<?php

use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;

use yii\grid\GridView;

?>
<!-- _gridview.php -->

<?= GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider([
        'allModels' => $requests,
        // Additional configuration for ArrayDataProvider if needed
    ]),
    'columns' => [
        'id',
        'meal_id',
        'observation',
        'plate.title',
        'quantity',
        // Other columns...
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            },
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{customButton}', // template custom
            'buttons' => [
                'customButton' => function ($url, $model, $key) {
                    return Html::a(
                        '<i class="fas fa-check"></i>',
                        ['delivered', 'id' => $model->id], // url para action
                    );
                },
            ],
        ],



    ],
]); ?>
