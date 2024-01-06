<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Reserva';
?>

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
            <div class="row g-4 justify-content-center">
                <div class="col-12">
                    <div class="row gy-4 text-center">
                        <div class="col-md-4">
                            <h5 class="section-title ff-secondary fw-normal text-start text-primary">Booking</h5>
                            <p><i class="fa fa-envelope-open text-primary me-2"></i>geral@horadapapa.com</p>
                        </div>
                        <div class="col-md-4">
                            <h5 class="section-title ff-secondary fw-normal text-start text-primary">General</h5>
                            <p><i class="fa fa-envelope-open text-primary me-2"></i>info@horadapapa.com</p>
                        </div>
                        <div class="col-md-4">
                            <h5 class="section-title ff-secondary fw-normal text-start text-primary">Technical</h5>
                            <p><i class="fa fa-envelope-open text-primary me-2"></i>apoio@horadapapa.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>