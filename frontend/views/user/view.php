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
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'role.description',
            'email:email',
            'userInfo.name',
            'userInfo.surname',
            'userInfo.nif',
        ],
    ]) ?>

</div>