<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\models\HelpticketSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pedidos de Ajuda';
?>

<div class="helpticket-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if ($resolved)
    {
        echo Html::a('Ver pedidos por resolver', ['index', 'resolved' => 0], ['class' => 'btn btn-primary']);
    }
    else
    {
        echo Html::a('Ver pedidos já resolvidos', ['index', 'resolved' => 1], ['class' => 'btn btn-primary']);
    }
    ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => 'view',
    ]); ?>

</div>