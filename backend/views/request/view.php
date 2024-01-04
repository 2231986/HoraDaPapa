<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use console\controllers\RbacController;

/** @var yii\web\View $this */
/** @var app\models\Request $model */

\yii\web\YiiAsset::register($this);
?>

<div class="request-view">

    <p>
        <?php
        if (\Yii::$app->user->can(RbacController::$RoleCooker))
        {
            echo Html::a('Cozinhar', ['cooked', 'id' => $model->id], ['class' => 'btn btn-primary']);
        }
        else if (\Yii::$app->user->can(RbacController::$RoleWaiter))
        {
            echo Html::a('Entregar', ['delivered', 'id' => $model->id], ['class' => 'btn btn-primary']);
        }
        else
        {
            echo Html::a('Cozinhar', ['Cooked', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo Html::a('Entregar', ['Delivered', 'id' => $model->id], ['class' => 'btn btn-primary']);
        }
        ?>

        <?= Html::a('Remover', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem acerteza que pretende remover este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'meal.dinner_table_id',
            'observation',
            'quantity',
            [
                'attribute' => 'user.username',
                'format' => 'raw',
                'value' => function ($model)
                {
                    return Html::a($model->user->username, ['user/view', 'id' => $model->user->id]);
                },
            ],
            [
                'attribute' => 'plate.title',
                'format' => 'raw',
                'value' => function ($model)
                {
                    return Html::a($model->plate->title, ['plate/view', 'id' => $model->plate->id]);
                },
            ],
            'plate.description',
            'date_time',
        ],
    ]) ?>


</div>