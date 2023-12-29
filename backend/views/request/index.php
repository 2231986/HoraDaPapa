<?php

use app\models\Request;
use yii\grid\GridView;
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




    <div class="request-index">
        <?php foreach ($groupedRequests as $dinnerTableId => $requests): ?>
            <div class="dinner-table">
                <h3>MESA: <?= $dinnerTableId; ?></h3>
                <?= $this->render('_gridview', ['requests' => $requests]) ?>
            </div>
        <?php endforeach; ?>
    </div>


</div>