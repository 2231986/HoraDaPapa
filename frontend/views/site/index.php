<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Página Inicial';
?>
<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container my-5 py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 text-center text-lg-start">
                <h1 class="display-3 text-white animated slideInLeft">Deguste as<br>nossas papas.</h1>
                <p class="text-white animated slideInLeft mb-4 pb-2">Encontre os seu pratos favoritos</p>
                <a href="" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Reserve</a>
            </div>
            <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                <img class="img-fluid" src="img/hero.png" alt="">
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6">
    <h5 class="section-title ff-secondary text-start text-primary fw-normal">Bem-Vindo</h5>
    <h1 class="mb-4">É <i class="fa fa-utensils text-primary me-2"></i>Hora da Papa!</h1>
    <p class="mb-4">Descubra nosso delicioso cardápio e desfrute de uma maravilhosa experiência gastronômica.</p>
    <p class="mb-4">Papinhas, papinhas... Qual vai ser a tua hoje?</p>
    <div class="row g-4 mb-4">
        <div class="col-sm-6">
            <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">15</h1>
                <div class="ps-4">
                    <p class="mb-0">especialidades da</p>
                    <h6 class="text-uppercase mb-0">casa</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">2</h1>
                <div class="ps-4">
                    <p class="mb-0">Estrelas</p>
                    <h6 class="text-uppercase mb-0">Michelin!</h6>
                </div>
            </div>
        </div>
    </div>
    <a class="btn btn-primary py-3 px-5 mt-2" href="/HoraDaPapa/frontend/web/site/about">Sobre nós..</a>
</div>
<!-- INICIO PRATOS-->

<div class="container-xxl pt-5 pb-3">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">A nossa equipa</h5>
            <h1 class="mb-5">Os nossos chef's!</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                <div class="team-item text-center rounded overflow-hidden">
                    <div class="rounded-circle overflow-hidden m-4">
                        <img class="img-fluid" src="img/team-1.jpg" alt="">
                    </div>
                    <h5 class="mb-0">Joao Galamba</h5>
                    <small>Designation</small>
                    <div class="d-flex justify-content-center mt-3">
                        <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                <div class="team-item text-center rounded overflow-hidden">
                    <div class="rounded-circle overflow-hidden m-4">
                        <img class="img-fluid" src="img/team-2.jpg" alt="">
                    </div>
                    <h5 class="mb-0">Antonio Costa</h5>
                    <small>Designation</small>
                    <div class="d-flex justify-content-center mt-3">
                        <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                <div class="team-item text-center rounded overflow-hidden">
                    <div class="rounded-circle overflow-hidden m-4">
                        <img class="img-fluid" src="img/team-3.jpg" alt="">
                    </div>
                    <h5 class="mb-0">Fernando Medina</h5>
                    <small>Designation</small>
                    <div class="d-flex justify-content-center mt-3">
                        <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s" style="visibility: visible; animation-delay: 0.7s; animation-name: fadeInUp;">
                <div class="team-item text-center rounded overflow-hidden">
                    <div class="rounded-circle overflow-hidden m-4">
                        <img class="img-fluid" src="img/team-4.jpg" alt="">
                    </div>
                    <h5 class="mb-0">Carlos Moedas</h5>
                    <small>Designation</small>
                    <div class="d-flex justify-content-center mt-3">
                        <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
    <div class="row g-0">
        <div class="col-md-6">
            <div class="video">

            </div>
        </div>
        <div class="col-md-6 bg-dark d-flex align-items-center">
            <div class="p-5 wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
                <h1 class="text-white mb-4">Reserve a sua mesa</h1>
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" placeholder="Nome">
                                <label for="name">Your Name</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" placeholder="Email">
                                <label for="email">Your Email</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" placeholder="Assunto">
                                <label for="subject">Subject</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Pedido" id="message" style="height: 100px"></textarea>
                                <label for="message">Special Request</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Registe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="site-index">
    <div class="jumbotron text-center">

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


<!-- Menu Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Menu</h5>
            <h1 class="mb-5">Most Popular Items</h1>
        </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded" src="img/menu-1.jpg" alt="" style="width: 80px;">
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <h5 class="d-flex justify-content-between border-bottom pb-2">
                                        <span>Chicken Burger</span>
                                        <span class="text-primary">$115</span>
                                    </h5>
                                    <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded" src="img/menu-2.jpg" alt="" style="width: 80px;">
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <h5 class="d-flex justify-content-between border-bottom pb-2">
                                        <span>Chicken Burger</span>
                                        <span class="text-primary">$115</span>
                                    </h5>
                                    <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded" src="img/menu-3.jpg" alt="" style="width: 80px;">
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <h5 class="d-flex justify-content-between border-bottom pb-2">
                                        <span>Chicken Burger</span>
                                        <span class="text-primary">$115</span>
                                    </h5>
                                    <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Menu End -->