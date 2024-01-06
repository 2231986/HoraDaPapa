<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Acerca';
?>
<div class="site-about">
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="row g-3">
                        <?php $aboutImages = [
                            Yii::$app->request->baseUrl . '/img/about-1.jpg',
                            Yii::$app->request->baseUrl . '/img/about-2.jpg',
                            Yii::$app->request->baseUrl . '/img/about-3.jpg',
                            Yii::$app->request->baseUrl . '/img/about-4.jpg'
                        ]; ?>                        <?php foreach ($aboutImages as $index => $image) : ?>
                            <div class="col-6 text-<?= ($index % 2 == 0) ? 'start' : 'end'; ?>">
                                <img class="img-fluid rounded <?= ($index % 2 == 0) ? 'w-100' : 'w-75'; ?> wow zoomIn" data-wow-delay="<?= 0.1 + ($index * 0.2); ?>s" src="<?= $image; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h5 class="section-title ff-secondary text-start text-primary fw-normal">Sobre nós</h5>
                    <h1 class="mb-4">Bem vindo à Hora da Papa!</h1>
                    <p class="mb-4">Descubra nosso delicioso cardápio e desfrute de uma maravilhosa experiência gastronômica.</p>
                    <p class="mb-4">Papinhas, papinhas... Qual vai ser a tua hoje?</p>
                    <div class="row g-4 mb-4">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                                <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">2</h1>
                                <div class="ps-4">
                                    <p class="mb-0">Estrelas</p>
                                    <h6 class="text-uppercase mb-0">Michelin!</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                                <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">15</h1>
                                <div class="ps-4">
                                    <p class="mb-0">Especialidades da</p>
                                    <h6 class="text-uppercase mb-0">casa</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?= \yii\helpers\Html::a('Sobre nós..', ['/site/about'], ['class' => 'btn btn-primary py-3 px-5 mt-2']) ?>
                    <?= \yii\helpers\Html::a('Pratos', ['plate/index'], ['class' => 'btn btn-primary py-3 px-5 mt-2']) ?>
                </div>
            </div>
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
    </div>


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Serviços</h5>
                <h1 class="mb-5">Explore os nossos serviços</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-user-tie text-primary mb-4"></i>
                            <h5>A nossa equipa!</h5>
                            <p>Uma equipa de profissionais de serviço ao cliente comprometida em proporcionar uma experiência memorável a cada cliente. Trabalhamos juntos para criar pratos inspiradores e um ambiente acolhedor.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-utensils text-primary mb-4"></i>
                            <h5>Compromisso de qualidade</h5>
                            <p>Garantia de ingredientes frescos e de alta qualidade em todas as refeições.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-cart-plus text-primary mb-4"></i>
                            <h5>Pedidos Online</h5>
                            <p>Descarrege a nossa aplicação HoraDaPapaAPP para fazer pedidos em mesa</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-headset text-primary mb-4"></i>
                            <h5>Apoio ao cliente</h5>
                            <p>Seja presencialmente, ou remotamente, estamos sempre disponiveis para si!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    <!-- Service End -->



