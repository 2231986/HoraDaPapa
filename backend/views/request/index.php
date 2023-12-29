<?php

use app\models\Request;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\models\RequestSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pedidos';
?>
<div class="request-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);
    ?>

<!--    --><?php /*//= ListView::widget([             LISTVIEW ANTIGA, PUXA PEDIDOS; NOT GROUPED
        'dataProvider' => $dataProvider,

        'itemView' => 'view',
    ]); */?>


    <?php foreach ($groupedRequests as $dinnerTableId => $requests): ?>
        <h2>Dinner Table ID: <?= $dinnerTableId ?></h2>
        <?= \yii\widgets\ListView::widget([
            'dataProvider' => new \yii\data\ArrayDataProvider([
                'allModels' => $requests,
                'pagination' => false,
            ]),
            'itemView' => '_item',
        ])?>
    <?php endforeach?>

</div>