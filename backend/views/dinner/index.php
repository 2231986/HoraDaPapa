<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\widgets\Alert;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mesas';

?>

<?= Alert::widget() ?>

<div class="dinner-index">

    <?php
    if ($cleaned) {
        echo "<p>" . Html::a('Mesas por limpar', ['index', 'cleaned' => 0], ['class' => 'btn btn-primary']) . "</p>";
    } else {
        echo "<p>" . Html::a('Mesas limpas', ['index', 'cleaned' => 1], ['class' => 'btn btn-primary']) . "</p>";
    }
    ?>

    <p>
        <?= Html::a('Criar Mesa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'date_time',
            [
                'attribute' => 'isClean',
                'value' => function ($model) {
                    return $model->isClean ? 'Limpa' : 'Suja';
                },
                'format' => 'raw',
                'contentOptions' => function ($model) {
                    return [
                        'style' => 'color: ' . ($model->isClean ? 'green' : 'red'),
                    ];
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>



</div>
