<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = 'Atualizar Dados:';
?>
<div class="user-update">

    <div class="row">
        <div class="col">
            <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <?= $this->render('_form', [
        'user' => $user,
        'userInfo' => $userInfo,
    ]) ?>

</div>