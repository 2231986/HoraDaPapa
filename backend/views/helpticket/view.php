<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use console\controllers\RbacController;

/** @var yii\web\View $this */
/** @var app\models\Helpticket $model */

\yii\web\YiiAsset::register($this);
?>

<div class="helpticket-view">

    <p>
        <?= Html::a('Mudar estado', ['resolved', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?php
        $userID =  Yii::$app->user->getId();

        if (Yii::$app->authManager->getAssignment(RbacController::$RoleAdmin, $userID))
        {
            echo Html::a('Remover', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
        }

        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Data',
                'attribute' => 'date_time',
            ],
            [
                'label' => 'Nome',
                'attribute' => 'user.username',
            ],
            [
                'label' => 'Descrição',
                'attribute' => 'description',
            ],
        ],
    ]) ?>

</div>