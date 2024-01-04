<?php

use app\models\Review;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ReviewSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Avaliações';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Cliente',
                'attribute' => 'user.username',
                'format' => 'raw', // Set the format to raw to allow rendering HTML
                'value' => function ($model)
                {
                    return Html::a($model->user->username, ['user/view', 'id' => $model->user->id]);
                },
            ],
            [
                'label' => 'Prato',
                'attribute' => 'plate.title',
                'format' => 'raw', // Set the format to raw to allow rendering HTML
                'value' => function ($model)
                {
                    return Html::a($model->plate->title, ['plate/view', 'id' => $model->plate->id]);
                },
            ],
            'value',
            'date_time',
            [
                'class' => ActionColumn::class,
                'template' => '{view}',
                'urlCreator' => function ($action, Review $model, $key, $index, $column)
                {
                    return Url::toRoute(['view', 'id' => $model->id]);
                },
            ],
        ],
    ]); ?>



</div>