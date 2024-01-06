<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\User $model */


$this->title = $model->id;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">
    <!-- Team Start -->
    <div class="container-xxl pt-5 pb-3">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item text-center rounded overflow-hidden">


                        <?= Html::a(
                            Html::img(
                                Url::to('@web/img/user-img.png'),
                                ['class' => 'img-fluid', 'alt' => 'User Image']
                            ),
                            ['update', 'id' => $model->id]
                        ) ?>

                        <h5 class="mb-0"><?= $model->username ?></h5>
                        <small>Role: <?= $model->role->description ?></small>
                        <h5 class="mb-0"><?= $model->email ?></h5>
                        <h5 class="mb-0"><?= $model->userInfo->name ?></h5>
                        <h5 class="mb-0"><?= $model->userInfo->surname ?></h5>
                        <h5 class="mb-0"><?= $model->userInfo->nif ?></h5>
                        <div class="d-flex justify-content-center mt-3">
                            <a class="btn btn-square btn-primary mx-1" href="<?= Url::to(['update', 'id' => $model->id]) ?>">
                                <i class="fa fa-edit"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





</div>