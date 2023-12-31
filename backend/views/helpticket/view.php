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
        <?= Html::a('Resolver', ['resolved', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?php
        $userID =  Yii::$app->user->getId();

        if (Yii::$app->authManager->getAssignment(RbacController::$RoleAdmin, $userID))
        {
            echo Html::a('Remover', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Tem acerteza que pretende remover este item?',
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
                'label' => 'Cliente',
                'format' => 'raw',
                'value' => function ($model)
                {
                    if ($model->user != null)
                    {
                        $username = $model->user->username;
                        $userId = $model->user_id;
                        $url = \yii\helpers\Url::to(['user/view', 'id' => $userId]);

                        return Html::a($username, $url);
                    }
                    else
                    {
                        return '--';
                    }
                },
            ],
            [
                'label' => 'Descrição',
                'attribute' => 'description',
            ],
        ],
    ]) ?>

</div>