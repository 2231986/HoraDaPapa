<?php

use app\models\Favorite;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\widgets\Alert;

/** @var yii\web\View $this */
/** @var app\models\FavoriteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Favoritos';
?>

<?= Alert::widget() ?>

<div class="favorite-index">

    <!-- Team Start -->
    <div class="container-xxl pt-5 pb-3">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Favoritos</h5>
                <h1 class="mb-5">As suas papas favoritas!</h1>
            </div>
            <div class="row g-4 justify-content-center align-items-center">
                <?php foreach ($dataProvider->getModels() as $model): ?>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item text-center rounded overflow-hidden">
                            <!-- You can use the appropriate data from your model -->
                            <div class="rounded-circle overflow-hidden m-4">
                                <?= Html::a(
                                    Html::img(
                                        $model->plate->image_name ? Yii::$app->params['imagePath'] . $model->plate->image_name : Yii::getAlias('@web/img/nopic.jpg'),
                                        ['class' => 'img-fluid', 'alt' => Html::encode($model->plate->title)]
                                    ),
                                    Url::to(['update', 'id' => $model->id])
                                ) ?>
                            </div>
                            <h5 class="mb-0"><?= Html::encode($model->plate->title) ?></h5>
                            <small><?= Html::encode($model->date_time) ?></small>
                            <div class="d-flex justify-content-center mt-3">
                                <!-- Define the action links for view, update, and delete -->
                                <a class="btn btn-square btn-primary mx-1" href="<?= Url::to(['update', 'id' => $model->id]) ?>">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="<?= Url::to(['delete', 'id' => $model->id]) ?>"
                                   data-confirm="Are you sure you want to delete this item?"
                                   data-method="post"
                                   class="btn btn-square btn-primary mx-1">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <a href="<?= Url::to(['favorite/create']) ?>">
                            <div class="rounded-circle overflow-hidden m-4">
                                <img class="img-fluid" src="<?= Url::to('@web/img/add-fav.png') ?>" alt="">
                            </div>
                        </a>
                        <h5 class="mb-0">Adicione</h5>
                        <small>Adicione Favoritos</small>
                        <div class="d-flex justify-content-center mt-3">
                            <a class="btn btn-square btn-primary mx-1" href="<?= Url::to(['favorite/create']) ?>">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>