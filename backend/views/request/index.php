<?php

use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use console\controllers\RbacController;
use common\widgets\Alert;

$groupedRequests = [];

foreach ($dataProvider->getModels() as $request)
{
    if ($request->meal != null)
    {
        $dinnerTableId = $request->meal->dinner_table_id;
        $groupedRequests[$dinnerTableId][] = $request;
    }
}

?>

<?= Alert::widget() ?>

<div class="request-index">

    <?php if (Yii::$app->user->can(RbacController::$RoleAdmin)) : ?>
        <p>
            <?= Html::a('Criar Pedido', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?php foreach ($groupedRequests as $dinnerTableId => $requests) : ?>
        <div class="dinner-table">
            <h3>MESA: <?= $dinnerTableId; ?></h3>
            <?= GridView::widget([
                'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $requests]),
                'columns' => [
                    [
                        'attribute' => 'id',
                        'label' => 'Pedido',
                    ],
                    [
                        'attribute' => 'meal_id',
                        'label' => 'Refeição',
                    ],
                    [
                        'attribute' => 'meal.dinner_table_id',
                        'label' => 'Mesa',
                        'format' => 'raw',
                        'value' => function ($model)
                        {
                            return Html::a($model->meal->dinner->name, ['dinner/view', 'id' => $model->meal->dinner_table_id]);
                        },
                    ],
                    [
                        'attribute' => 'user.username',
                        'label' => 'Cliente',
                        'format' => 'raw',
                        'value' => function ($model)
                        {
                            return Html::a($model->user->username, ['user/view', 'id' => $model->user_id]);
                        },
                    ],
                    [
                        'attribute' => 'observation',
                        'value' => function ($model)
                        {
                            return empty($model->observation) ? '--' : $model->observation;
                        },
                    ],
                    [
                        'attribute' => 'plate.title',
                        'format' => 'raw',
                        'value' => function ($model)
                        {
                            return Html::a($model->plate->title, ['plate/view', 'id' => $model->plate->id]);
                        },
                    ],
                    'quantity',
                    [
                        'attribute' => 'isCooked',
                        'value' => function ($model)
                        {
                            return $model->isCooked ? 'Sim' : 'Não';
                        },
                        'format' => 'raw',
                        'contentOptions' => function ($model)
                        {
                            return [
                                'style' => 'color: ' . ($model->isCooked ? 'green' : 'red'),
                            ];
                        },
                    ],
                    [
                        'attribute' => 'isDelivered',
                        'value' => function ($model)
                        {
                            return $model->isDelivered ? 'Sim' : 'Não';
                        },
                        'format' => 'raw',
                        'contentOptions' => function ($model)
                        {
                            return [
                                'style' => 'color: ' . ($model->isDelivered ? 'green' : 'red'),
                            ];
                        },
                    ],
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, $model, $key, $index, $column)
                        {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        },
                        'template' => '{view} {update} {delete} {cookedButton} {deliveredButton}',
                        'buttons' => [
                            'cookedButton' => function ($url, $model, $key)
                            {
                                if (Yii::$app->user->can(RbacController::$RoleAdmin) || Yii::$app->user->can(RbacController::$RoleCooker))
                                {
                                    return Html::a(
                                        '<i class="fas fa-utensils"></i>',
                                        ['cooked', 'id' => $model->id],
                                        [
                                            'title' => 'Marcar como cozinhado',
                                            'data' => [
                                                'toggle' => 'tooltip',
                                                'placement' => 'bottom',
                                            ],
                                        ]
                                    );
                                }
                                return '';
                            },
                            'deliveredButton' => function ($url, $model, $key)
                            {
                                if (Yii::$app->user->can(RbacController::$RoleAdmin) || Yii::$app->user->can(RbacController::$RoleWaiter))
                                {
                                    return Html::a(
                                        '<i class="fas fa-truck"></i>',
                                        ['delivered', 'id' => $model->id],
                                        [
                                            'title' => 'Marcar como entregue',
                                            'data' => [
                                                'toggle' => 'tooltip',
                                                'placement' => 'bottom',
                                            ],
                                        ]
                                    );
                                }
                                return '';
                            },
                        ],

                    ],
                ],
            ]);
            ?>
        </div>
    <?php endforeach; ?>
</div>