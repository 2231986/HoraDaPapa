<?php

use app\models\Meal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\MealSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Meals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meal-index">

    <?php
    if ($checkout)
    {
        echo "<p>" . Html::a('Ver refeições abertas', ['index', 'checkout' => 0], ['class' => 'btn btn-primary']) . "</p>";
    }
    else
    {
        echo "<p>" . Html::a('Ver refeições fechadas', ['index', 'checkout' => 1], ['class' => 'btn btn-primary']) . "</p>";
    }
    ?>

    <p>
        <?= Html::a('Create Meal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Número de Mesa',
                'attribute' => 'dinner.id',
            ],
            [
                'label' => 'Nome de Mesa',
                'attribute' => 'dinner.name',
            ],
            'date_time',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Meal $model, $key, $index, $column)
                {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>