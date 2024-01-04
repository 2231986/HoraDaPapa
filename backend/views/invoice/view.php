<?php

use common\helpers\FormatterHelper;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Invoice $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Faturas', 'url' => ['index']];
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
            [
                'label' => 'Cliente',
                'format' => 'raw',
                'value' => function ($model)
                {
                    if ($model->user != null)
                    {
                        $username = $model->user->username;
                        $userId = $model->user_id;
                        $url = \yii\helpers\Url::to(['user/view', 'id' => $userId]);

                        return Html::a($username, $url);
                    }
                    else
                    {
                        return '--';
                    }
                },
            ],
            [
                'label' => 'NIF',
                'attribute' => 'user.userInfo.nif',
                'value' => function ($model)
                {
                    return empty($model->user->userInfo->nif) ? '999999999' : $model->user->userInfo->nif;
                },
            ],
            [
                'label' => 'Nome da mesa',
                'format' => 'raw',
                'value' => function ($model)
                {
                    return Html::a($model->meal->dinner->name, ['dinner/view', 'id' => $model->meal->dinner->id]);
                },
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
                            [
                                'attribute' => 'plate.title',
                                'format' => 'raw',
                                'value' => function ($model)
                                {
                                    return Html::a($model->plate->title, ['plate/view', 'id' => $model->plate->id]);
                                },
                            ],
                            [
                                'attribute' => 'price',
                                'label' => 'Preço',
                                'value' => function ($model)
                                {
                                    return FormatterHelper::formatCurrency($model->price);
                                },
                            ],
                            [
                                'attribute' => 'observation',
                                'value' => function ($model)
                                {
                                    return empty($model->observation) ? '--' : $model->observation;
                                },
                            ],
                        ],
                    ]);
                },
            ],
        ],
    ]) ?>

</div>