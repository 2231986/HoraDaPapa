<?php

use common\models\Plate;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\helpers\FormatterHelper;
use common\widgets\Alert;

/** @var yii\web\View $this */
/** @var common\models\PlateSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pratos';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= Alert::widget() ?>

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
            [
                'attribute' => 'price',
                'label' => 'Preço',
                'value' => function ($model)
                {
                    return FormatterHelper::formatCurrency($model->price);
                },
            ],
            'title',
            'date_time',
            //'image_name',
            [
                'attribute' => 'supplier_id',
                'format' => 'raw',
                'value' => function ($model)
                {
                    return Html::a($model->supplier->name, Url::toRoute(['supplier/view', 'id' => $model->supplier_id]));
                },
            ],
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