<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Favorite $model */

$this->title = 'Criar Favorito';
$this->params['breadcrumbs'][] = ['label' => 'Favoritos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="favorite-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>