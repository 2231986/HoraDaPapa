<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\User $user */

$this->title = $user->id;
$this->params['breadcrumbs'][] = ['label' => 'Utilizadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $user->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Remover', ['delete', 'id' => $user->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem acerteza que pretende remover este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $user,
        'attributes' => [
            'username',
            'role.description',
            'email:email',
            [
                'attribute' => 'userInfo.name',
                'value' => function ($model)
                {
                    return $model->userInfo->name != null ? $model->userInfo->name : '--';
                },
            ],
            [
                'attribute' => 'userInfo.surname',
                'value' => function ($model)
                {
                    return $model->userInfo->surname != null ? $model->userInfo->surname : '--';
                },
            ],
            [
                'attribute' => 'userInfo.nif',
                'value' => function ($model)
                {
                    return $model->userInfo->nif != null ? $model->userInfo->nif : '--';
                },
            ],

        ],
    ]) ?>

</div>