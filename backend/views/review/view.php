<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Review $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="review-view">

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Remover', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                'label' => 'Prato',
                'format' => 'raw',
                'value' => function ($model)
                {
                    if ($model->plate != null)
                    {
                        $plateTitle = $model->plate->title;
                        $plateId = $model->plate_id;
                        $url = \yii\helpers\Url::to(['plate/view', 'id' => $plateId]);

                        return Html::a($plateTitle, $url);
                    }
                    else
                    {
                        return '--';
                    }
                },
            ],
            'description',
            'value',
            'date_time',
        ],
    ]) ?>

</div>