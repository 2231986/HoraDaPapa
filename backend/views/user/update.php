<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $user */

$this->title = 'Atualizar Utilizador: ' . $user->id;
$this->params['breadcrumbs'][] = ['label' => 'Utilizadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->id, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="user-update">

    <?= $this->render('_form', [
        'userRoles' => $user->getAllRoles(),
        'userRole' => $user->getRole(),
        'user' => $user,
        'userInfo' => $userInfo,
    ]) ?>

</div>