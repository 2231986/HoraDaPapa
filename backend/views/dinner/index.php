<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\models\DinnerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mesas';
?>

<div class="dinner-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if ($cleaned)
    {
        echo "<p>" . Html::a('Mesas por limpar', ['index', 'cleaned' => 0], ['class' => 'btn btn-primary']) . "</p>";
    }
    else
    {
        echo "<p>" . Html::a('Mesas limpas', ['index', 'cleaned' => 1], ['class' => 'btn btn-primary']) . "</p>";
    }
    ?>

    <p>
        <?= Html::a('Criar Mesa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => 'view',
    ]); ?>


</div>