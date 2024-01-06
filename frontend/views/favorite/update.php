<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Favorite $model */

$this->title = 'Atualizar Favorito:';
?>
<div class="favorite-update">

    <div class="row">
        <div class="col">
            <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>