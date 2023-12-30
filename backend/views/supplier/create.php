<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Supplier $model */

$this->title = 'Criar Fornecedor';
$this->params['breadcrumbs'][] = ['label' => 'Fornecedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-create">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>