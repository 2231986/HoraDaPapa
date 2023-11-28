<?php

use app\models\Helpticket;
use app\models\Meal;
use common\models\Favorite;
use common\models\User;

$this->title = 'Página Principal';
?>
<div class="container-fluid">

    <!-- <div class="row">
        <div class="col-lg-6">
            <?= \hail812\adminlte\widgets\Alert::widget([
                'type' => 'success',
                'body' => '<h3>' . 'Bem-vindo!</h3>',
            ]) ?>

            <?= \hail812\adminlte\widgets\Callout::widget([
                'type' => 'danger',
                'head' => 'I am a danger callout!',
                'body' => 'There is a problem that we need to fix. A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
            ]) ?>

        </div>
    </div> -->

    <!-- <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'CPU Traffic',
                'number' => '10 <small>%</small>',
                'icon' => 'fas fa-cog',
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Messages',
                'number' => '1,410',
                'icon' => 'far fa-envelope',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Bookmarks',
                'number' => '410',
                'theme' => 'success',
                'icon' => 'far fa-flag',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Uploads',
                'number' => '13,648',
                'theme' => 'gradient-warning',
                'icon' => 'far fa-copy',
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Bookmarks',
                'number' => '41,410',
                'icon' => 'far fa-bookmark',
                'progress' => [
                    'width' => '70%',
                    'description' => '70% Increase in 30 Days'
                ]
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?php $infoBox = \hail812\adminlte\widgets\InfoBox::begin([
                'text' => 'Likes',
                'number' => '41,410',
                'theme' => 'success',
                'icon' => 'far fa-thumbs-up',
                'progress' => [
                    'width' => '70%',
                    'description' => '70% Increase in 30 Days'
                ]
            ]) ?>
            <?= \hail812\adminlte\widgets\Ribbon::widget([
                'id' => $infoBox->id . '-ribbon',
                'text' => 'Ribbon',
            ]) ?>
            <?php \hail812\adminlte\widgets\InfoBox::end() ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Events',
                'number' => '41,410',
                'theme' => 'gradient-warning',
                'icon' => 'far fa-calendar-alt',
                'progress' => [
                    'width' => '70%',
                    'description' => '70% Increase in 30 Days'
                ],
                'loadingStyle' => true
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '150',
                'text' => 'New Orders',
                'icon' => 'fas fa-shopping-cart',
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?php $smallBox = \hail812\adminlte\widgets\SmallBox::begin([
                'title' => '150',
                'text' => 'New Orders',
                'icon' => 'fas fa-shopping-cart',
                'theme' => 'success'
            ]) ?>
            <?= \hail812\adminlte\widgets\Ribbon::widget([
                'id' => $smallBox->id . '-ribbon',
                'text' => 'Ribbon',
                'theme' => 'warning',
                'size' => 'lg',
                'textSize' => 'lg'
            ]) ?>
            <?php \hail812\adminlte\widgets\SmallBox::end() ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '44',
                'text' => 'User Registrations',
                'icon' => 'fas fa-user-plus',
                'theme' => 'gradient-success',
                'loadingStyle' => true
            ]) ?>
        </div>
    </div> -->

    <h3>Visão Geral</h3>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <?php

            $userModel = new User();

            echo \hail812\adminlte\widgets\SmallBox::widget([
                'title' => count($userModel->getUserClients()),
                'text' => 'Clientes',
                'icon' => 'fas fa-user-plus',
                'theme' => 'gradient-success'
            ]);

            echo \hail812\adminlte\widgets\SmallBox::widget([
                'title' => count($userModel->getUserStaff()),
                'text' => 'Funcionários',
                'icon' => 'fas fa-user-plus',
                'theme' => 'gradient-success'
            ]);
            ?>
        </div>
    </div>

    <h3>Estatísticas de Hoje</h3>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <?php

            $helpticketModel = new Helpticket();
            $tickets = $helpticketModel->getTodayTickets();

            echo \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Pedidos de ajuda',
                'number' => count($tickets),
                'icon' => 'far fa-envelope',
            ]);

            $mealModel = new Meal();
            $meals = $mealModel->getTodayMeals();
            echo \hail812\adminlte\widgets\SmallBox::widget([
                'title' => count($meals),
                'text' => 'Refeições Servidas',
                'icon' => 'fas fa-shopping-cart',
            ]);

            $favoriteModel = new Favorite();
            $favorites = $favoriteModel->getTodayFavorites();
            $favoritesRatio = $favoriteModel->getFavoritesRatio();
            echo \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Favoritos',
                'number' => count($favorites),
                'theme' => 'success',
                'icon' => 'far fa-flag',
                'progress' => [
                    'width' => "$favoritesRatio%",
                    'description' => "$favoritesRatio% Aumento desde ontem"
                ]
            ]);
            ?>
        </div>
    </div>

</div>