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

        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php foreach ($groupedRequests as $tableId => $requests): ?>
        <h2>Dinner Table ID: <?= $tableId ?></h2>
        <ul>
            <?php foreach ($requests as $request): ?>
                <li>
                    <!-- Access properties of each $request here -->
                    Request ID: <?= $request->id ?>
                    <!-- Other properties -->
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'meal.dinner_table_id',
            'plate.title',
            'observation',
            'quantity',
            'user.username',
            'date_time',
        ],
    ]) ?>

</div>