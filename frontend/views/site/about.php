<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Acerca';
?>
<div class="site-about">
    <div class="jumbotron text-center">
        <h1>Sobre o Nosso Restaurante</h1>
        <p class="lead">Descubra a nossa história e paixão pela culinária.</p>
        <div class="col-md-12 text-center">
            <?= Html::img('https://hips.hearstapps.com/edc.h-cdn.co/assets/16/28/1468519884-ce-la-vie-restaurant.jpg?resize=980:*', ['class' => 'center-img', 'alt' => 'Your Image']) ?>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Nossa História</h2>
                <p>Desde a nossa inauguração em 2023, temos o prazer de servir deliciosas refeições para a comunidade. A nossa paixão pela gastronomia e o compromisso com ingredientes frescos definem a nossa experiência culinária única.</p>
            </div>
            <div class="col-md-6">
                <h2>Missão e Visão</h2>
                <p>A nossa missão é proporcionar uma experiência gastronômica excepcional, oferecendo pratos autênticos preparados com cuidado e paixão. Temos a visão de ser reconhecidos como um destino culinário de excelência, onde cada visita é uma celebração de sabores.</p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <h2>A nossa equipa</h2>
                <p>A nosso talentosa equipa de profissionais de serviço ao cliente está comprometida em proporcionar uma experiência memorável a cada cliente. Trabalhamos juntos para criar pratos inspiradores e um ambiente acolhedor.</p>
                <div class="col-md-12 text-center">
                    <?= Html::img('https://thumbs.dreamstime.com/z/generative-ai-restaurant-team-landing-page-template-characters-uniform-demonstrating-menu-cafe-cafeteria-staff-hospitality-279963796.jpg?w=992', ['class' => 'center-img', 'alt' => 'Your Image']) ?>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <h2>Compromisso com a Qualidade</h2>
                <p>Utilizamos apenas ingredientes frescos e de alta qualidade em todas as nossas preparações. Cada prato é cuidadosamente elaborado para garantir sabor e apresentação excepcionais.</p>
            </div>
        </div>

        <div class="row mt-5">
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
    </div>
</div>