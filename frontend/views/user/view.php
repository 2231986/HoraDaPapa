<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = $model->id;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode('Utilizador: ' . $this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'username',
                'label' => 'Nome de Cliente',
            ],
            [
                'attribute' => 'role.description',
                'label' => 'Função',
            ],
            [
                'attribute' => 'email',
                'format' => 'email',
                'label' => 'Email',
            ],
            [
                'attribute' => 'userInfo.name',
                'label' => 'Nome',
            ],
            [
                'attribute' => 'userInfo.surname',
                'label' => 'Sobrenome',
            ],
            [
                'attribute' => 'userInfo.nif',
                'label' => 'NIF',
            ],
        ],
    ]) ?>


</div>