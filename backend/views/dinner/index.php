<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use common\widgets\Alert;

/** @var yii\web\View $this */
/** @var app\models\DinnerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mesas';

?>

<?= Alert::widget() ?>

<div class="dinner-index">

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