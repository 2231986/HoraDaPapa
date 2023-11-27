<?php

use common\models\Plate;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\PlateSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pratos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plate-index">

    <p>
        <?= Html::a('Criar Prato', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'description',
            'price',
            'title',
            'date_time',
            //'image_name',
            'supplier.name',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Plate $model, $key, $index, $column)
                {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>