<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Página Inicial';
?>

<div class="site-index">
    <div class="jumbotron text-center">
        <h1>Hora da Papa</h1>
        <p class="lead">Descubra nosso delicioso cardápio e desfrute de uma maravilhosa experiência gastronômica.</p>
        <div class="col-md-12 text-center">
            <?= Html::img('https://hips.hearstapps.com/edc.h-cdn.co/assets/16/28/3200x1550/gallery-1468508286-ce-la-vi-restaurant-indoor.jpg?resize=1100:*', ['class' => 'center-img', 'alt' => 'Your Image']) ?>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Explora o nosso Menu</h2>
                <p>Delicie-se com uma variedade de pratos deliciosos cuidadosamente elaborados pelos nossos chefs.</p>
                <?= Html::a('Pratos', ['plate/index'], ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="col-md-6">
                <h2>Faz uma Reserva</h2>
                <p>Reserve uma mesa para uma experiência gastronômica inesquecível com seus entes queridos.</p>
                <?= Html::a('Reserva', ['site/contact'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <h2>Pratos Populares</h2>
                <!-- Add a simple image gallery using Bootstrap classes -->
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <img src="https://img.freepik.com/premium-psd/pasta-instagram-flyer-post_124799-133.jpg?w=740" class="img-fluid" alt="Food Image 1">
                    </div>
                    <div class="col-md-4 mb-3">
                        <img src="https://img.freepik.com/premium-psd/pasta-instagram-flyer-post_124799-133.jpg?w=740" class="img-fluid" alt="Food Image 2">
                    </div>
                    <div class="col-md-4 mb-3">
                        <img src="https://img.freepik.com/premium-psd/pasta-instagram-flyer-post_124799-133.jpg?w=740" class="img-fluid" alt="Food Image 3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>