<?php

use app\models\Favorite;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\FavoriteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Favorites';
?>
<div class="favorite-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Favorite', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Nome do Prato',
                'attribute' => 'plate_id',
                'value' => function ($model)
                {
                    return $model->plate ? $model->plate->title : 'No Plate';
                },
            ],
            [
                'label' => 'Data',
                'value' => 'date_time'
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index)
                {
                    if ($action === 'view')
                    {
                        // Assuming 'plate/view' is the route for the plate view
                        return Url::to(['plate/view', 'id' => $model->plate_id]);
                    }
                    else
                    {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                },
            ],
        ],
    ]); ?>


</div>