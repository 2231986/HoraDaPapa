<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\models\HelpticketSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pedidos de Ajuda';
?>

<div class="helpticket-index">

    <?php
    if ($resolved)
    {
        echo "<p>" . Html::a('Ver pedidos por resolver', ['index', 'resolved' => 0], ['class' => 'btn btn-primary']) . "</p>";
    }
    else
    {
        echo "<p>" . Html::a('Ver pedidos já resolvidos', ['index', 'resolved' => 1], ['class' => 'btn btn-primary']) . "</p>";
    }
    ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => 'view',
    ]); ?>

</div>