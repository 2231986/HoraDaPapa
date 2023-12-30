<?php

use app\models\Invoice;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\helpers\FormatterHelper;

/** @var yii\web\View $this */
/** @var app\models\InvoiceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Invoices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-index">

    <p>
        <?= Html::a('Criar Fatura', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'price',
                'label' => 'Preço',
                'value' => function ($model)
                {
                    return FormatterHelper::formatCurrency($model->price);
                },
            ],
            'date_time',
            'user.userInfo.nif',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Invoice $model, $key, $index, $column)
                {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'template' => '{view} {delete}',
            ],
        ],
    ]); ?>

</div>