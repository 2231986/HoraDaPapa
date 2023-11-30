<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>
<div class="error-page">
    <div class="error-content" style="margin-left: auto;">
        <h3><i class="fas fa-exclamation-triangle text-danger"></i> <?= Html::encode($name) ?></h3>

        <p>
            <?= nl2br(Html::encode($message)) ?>
        </p>

        <p>
            Ocorreu um erro, poderá voltar para a <?= Html::a('Página Principal', Yii::$app->homeUrl); ?>
            ou voltar para a <?= Html::a('Página de Login', Url::toRoute(['site/login'])) ?>
        </p>

    </div>
</div>