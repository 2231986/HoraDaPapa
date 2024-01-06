<?php

/** @var yii\bootstrap5\ActiveForm $form */
/** @var ContactForm $model */

use frontend\models\ContactForm;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'Página Inicial';
?>
<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container my-5 py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 text-center text-lg-start">
                <h1 class="display-3 text-white fw-bold animate__animated animate__slideInLeft">Deguste as<br>nossas papas.</h1>
                <p class="text-white animate__animated animate__slideInLeft mb-4 pb-2">Encontre os seus pratos favoritos</p>
                <?= \yii\helpers\Html::a('Contacte-nos', ['/site/contact'], ['class' => 'btn btn-primary py-sm-3 px-sm-5 me-3 animate__animated animate__slideInLeft']) ?>
            </div>
            <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                <img class="img-fluid" src="img/hero.png" alt="Hero Image">
            </div>
        </div>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="row g-3">
                    <?php $aboutImages = ['img/about-1.jpg', 'img/about-2.jpg', 'img/about-3.jpg', 'img/about-4.jpg']; ?>
                    <?php foreach ($aboutImages as $index => $image) : ?>
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

<div class="container-xxl pt-5 pb-3">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Pratos populares</h5>
                    <h1 class="mb-5">Estas são as papas mais apreciadas!</h1>
                </div>
                <div class="row g-4 justify-content-center">
                    <?php foreach ($popularPlates as $plate) : ?>
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                            <div class="team-item text-center rounded overflow-hidden">
                                <div class="overflow-hidden m-4">
                                    <?= Html::a(
                                        Html::img(
                                            $plate->image_name ? Yii::$app->params['imagePath'] . $plate->image_name : Yii::getAlias('@web/img/nopic.jpg'),
                                            ['class' => 'img-fluid', 'alt' => Html::encode($plate->title)]
                                        ),
                                        ['plate/index']
                                    ) ?>
                                </div>
                                <h5 class="mb-0"><?= Html::encode($plate->title) ?></h5>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="col-12 text-center mt-4">
                        <?= \yii\helpers\Html::a('Ver Menu', ['plate/index'], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="site-contact">
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Contacto/Reserva</h5>
                <h1 class="mb-5">Preencha o formulário para nos contactar.</h1>
            </div>


            <div class="container-xxl py-5">
                <div class="row g-0">
                    <div class="col-md-6">
                        <div class="video">
                        </div>
                    </div>
                    <div class="col-md-6 bg-dark d-flex align-items-center">
                        <div class="p-5">
                            <h5 class="section-title ff-secondary text-start text-primary fw-normal">Contacto</h5>
                            <h1 class="text-white mb-4">Contacto</h1>
                            <?php $form = ActiveForm::begin(['action' => ['site/contact'], 'id' => 'contact-form', 'method' => 'post']); ?>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'name')->textInput(['placeholder' => 'Nome'])->label(false) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(false) ?>
                                </div>
                                <div class="col-12">
                                    <?= $form->field($model, 'subject')->textInput(['placeholder' => 'Assunto'])->label(false) ?>
                                </div>
                                <div class="col-12">
                                    <?= $form->field($model, 'body')->textarea(['rows' => 6, 'placeholder' => 'Pedido'])->label(false) ?>
                                </div>
                                <div class="col-lg-4">
                                    <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                                        'template' => '{image}',
                                        'options' => ['placeholder' => 'Captcha'],
                                    ])->label(false) ?>
                                </div>
                                <div class="col-lg-8">
                                    <?= $form->field($model, 'verifyCode')->textInput(['placeholder' => 'Enter Captcha'])->label(false) ?>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mt-4">
                                        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary w-100 py-3', 'name' => 'contact-button']) ?>
                                    </div>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>